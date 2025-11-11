<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Services\AuditService;

class TenantController extends Controller
{
    protected $auditService;

    public function __construct(AuditService $auditService)
    {
        $this->middleware(['auth', 'role:super_admin']);
        $this->auditService = $auditService;
    }

    public function index(Request $request)
    {
        $query = Tenant::withCount(['branches', 'users', 'products', 'sales']);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('business_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $tenants = $query->latest()->paginate(15);

        return view('super-admin.tenants.index', compact('tenants'));
    }

    public function create()
    {
        return view('super-admin.tenants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email',
            'contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'business_type' => 'nullable|string',
            'subscription_months' => 'nullable|integer|min:1',
            'admin_name' => 'required|string|max:255',
            'admin_username' => 'required|string|unique:users,username',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:8',
        ]);

        try {
            DB::beginTransaction();

            $tenant = Tenant::create([
                'name' => $request->name,
                'business_name' => $request->business_name,
                'email' => $request->email,
                'contact_number' => $request->contact_number,
                'address' => $request->address,
                'business_type' => $request->business_type,
                'is_active' => true,
                'subscription_expires_at' => $request->subscription_months 
                    ? now()->addMonths($request->subscription_months) 
                    : null,
            ]);

            $branch = Branch::create([
                'tenant_id' => $tenant->id,
                'name' => 'Main Branch',
                'code' => strtoupper(substr($tenant->slug, 0, 3)) . '-MAIN',
                'address' => $request->address ?? 'Main Office',
                'is_active' => true,
                'is_main_branch' => true,
            ]);

            User::create([
                'tenant_id' => $tenant->id,
                'branch_id' => $branch->id,
                'name' => $request->admin_name,
                'username' => $request->admin_username,
                'email' => $request->admin_email,
                'password' => Hash::make($request->admin_password),
                'role' => 'admin',
                'is_active' => true,
            ]);

            $this->auditService->log('CREATE', 'tenants', $tenant->id, null, $tenant->toArray());

            DB::commit();

            return redirect()->route('super-admin.tenants.index')
                ->with('success', 'Tenant created successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Failed: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(Tenant $tenant)
    {
        $tenant->load(['branches', 'users']);
        
        $stats = [
            'total_branches' => $tenant->branches()->count(),
            'active_branches' => $tenant->branches()->active()->count(),
            'total_users' => $tenant->users()->count(),
            'total_products' => $tenant->products()->count(),
            'total_sales' => $tenant->sales()->sum('total_amount'),
        ];

        return view('super-admin.tenants.show', compact('tenant', 'stats'));
    }

    public function edit(Tenant $tenant)
    {
        return view('super-admin.tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email,' . $tenant->id,
        ]);

        $tenant->update($request->only(['name', 'business_name', 'email', 'contact_number', 'address', 'business_type']));

        return redirect()->route('super-admin.tenants.show', $tenant)
            ->with('success', 'Tenant updated successfully');
    }

    public function toggleStatus(Tenant $tenant)
    {
        $tenant->update(['is_active' => !$tenant->is_active]);
        return back()->with('success', 'Status updated');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('super-admin.tenants.index')->with('success', 'Tenant deleted');
    }
}