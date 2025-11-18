<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\AuditService;

class BranchController extends Controller
{
    protected $auditService;

    public function __construct(AuditService $auditService)
    {
        $this->middleware(['auth', 'role:super_admin,admin']);
        $this->auditService = $auditService;
    }

    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'super_admin') {
            $branches = Branch::with('tenant')->latest()->paginate(15);
        } else {
            $branches = Branch::where('tenant_id', $user->tenant_id)->latest()->paginate(15);
        }

        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'manager_name' => 'required|string|max:255',
            'manager_username' => 'required|string|unique:users,username',
            'manager_email' => 'required|email|unique:users,email',
            'manager_password' => 'required|string|min:8',
        ]);

        $user = auth()->user();
        $tenantId = $user->role === 'super_admin' ? $request->tenant_id : $user->tenant_id;

        try {
            \DB::beginTransaction();

            $branch = Branch::create([
                'tenant_id' => $tenantId,
                'name' => $request->name,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'is_active' => true,
            ]);

            User::create([
                'tenant_id' => $tenantId,
                'branch_id' => $branch->id,
                'name' => $request->manager_name,
                'username' => $request->manager_username,
                'email' => $request->manager_email,
                'password' => Hash::make($request->manager_password),
                'role' => 'manager',
                'is_active' => true,
            ]);

            \DB::commit();

            return redirect()->route('branches.index')
                ->with('success', 'Branch created successfully!');

        } catch (\Exception $e) {
            \DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show(Branch $branch)
    {
        $stats = [
            'total_users' => $branch->users()->count(),
            'managers' => $branch->managers()->count(),
            'cashiers' => $branch->cashiers()->count(),
            'total_products' => $branch->products()->count(),
            'total_sales' => $branch->sales()->sum('total_amount'),
        ];

        return view('branches.show', compact('branch', 'stats'));
    }

    public function edit(Branch $branch)
    {
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        $branch->update($request->only(['name', 'address', 'contact_number', 'email']));

        return redirect()->route('branches.show', $branch)->with('success', 'Branch updated');
    }

    public function toggleStatus(Branch $branch)
    {
        $branch->update(['is_active' => !$branch->is_active]);
        return back()->with('success', 'Status updated');
    }

    public function destroy(Branch $branch)
    {
        if ($branch->is_main_branch) {
            return back()->withErrors(['error' => 'Cannot delete main branch']);
        }

        $branch->delete();
        return redirect()->route('branches.index')->with('success', 'Branch deleted');
    }
}