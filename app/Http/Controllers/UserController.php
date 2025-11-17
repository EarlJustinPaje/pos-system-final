<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\AuditService;

class UserController extends Controller
{
    protected $auditService;

    public function __construct(AuditService $auditService)
    {
        $this->middleware('auth');
        $this->auditService = $auditService;
    }

    public function index(Request $request)
{
    $user = auth()->user();
    $query = User::query();
    
    // Managers can only see users in their branch
    if ($user->isManager()) {
        $query->where('branch_id', $user->branch_id)
              ->where('role', 'cashier'); // Managers only see cashiers
    }
    
    // Admins see users in their tenant
    if ($user->isAdmin()) {
        $query->where('tenant_id', $user->tenant_id);
    }
    
    // Super admin sees everyone (no filter needed)
    
    if ($request->has('search')) {
        $search = $request->get('search');
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('username', 'like', "%{$search}%");
        });
    }
    
    $users = $query->get();
    
    return view('users.index', compact('users'));
}

public function deactivate(User $user)
{
    // Only admins and super admins can deactivate
    if (!auth()->user()->isAdmin() && !auth()->user()->isSuperAdmin()) {
        abort(403, 'Only admins can deactivate accounts');
    }
    
    $oldValues = $user->toArray();
    $user->update(['is_active' => false]);
    
    $this->auditService->log('DEACTIVATE', 'users', $user->id, $oldValues, $user->toArray());
    
    return redirect()->route('users.index')->with('success', 'User deactivated successfully');
}
    {
        $query = User::query();
        
        $user = auth()->user();
        $query = User::query();

        // Managers can only see cashiers in their branch
        if ($user->isManager()) {
            $query->where('branch_id', $user->branch_id)
                  ->where('role', 'cashier');
        }

        // Admins see users in their tenant
        if ($user->isAdmin()) {
            $query->where('tenant_id', $user->tenant_id);
        }

        // Super Admin sees everyone (no filter needed)

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }
        
        $users = $query->get();
        

        $users = $query->get();
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|unique:users,username,' . $user->id,
        ]);

        $oldValues = $user->toArray();
        $user->update($request->only(['name', 'email', 'username']));
        
        $this->auditService->log('UPDATE', 'users', $user->id, $oldValues, $user->toArray());
        
        
        $this->auditService->log('UPDATE', 'users', $user->id, $oldValues, $user->toArray());
        
        $this->auditService->log('UPDATE', 'users', $user->id, $oldValues, $user->toArray());

        return redirect()->route('users.show', $user)->with('success', 'Profile updated successfully');
    }

    public function resetPassword(User $user)
    {
        $newPassword = 'password123';
        $oldValues = ['password' => $user->password];
        
        $user->update(['password' => Hash::make($newPassword)]);
        
        $this->auditService->log('PASSWORD_RESET', 'users', $user->id, $oldValues, ['password' => 'reset']);
        
        return redirect()->route('users.show', $user)->with('success', "Password reset to: {$newPassword}");
    }

}
        $authUser = auth()->user();
        // Only Admins or Super Admins can reset passwords
        if (!$authUser->isAdmin() && !$authUser->isSuperAdmin()) {
            abort(403, 'You do not have permission to reset passwords.');
        }

        $newPassword = 'password123'; // or generate dynamically
        $oldValues = ['password' => $user->password];

        $user->update(['password' => Hash::make($newPassword)]);
        $this->auditService->log('PASSWORD_RESET', 'users', $user->id, $oldValues, ['password' => 'reset']);

        return redirect()->route('users.show', $user)->with('success', "Password reset to: {$newPassword}");
    }

    public function deactivate(User $user)
    {
        $oldValues = $user->toArray();
        $user->update(['is_active' => false]);
        
        $this->auditService->log('DEACTIVATE', 'users', $user->id, $oldValues, $user->toArray());
        
        return redirect()->route('users.index')->with('success', 'User deactivated successfully');
    }
}
        $authUser = auth()->user();

        // Managers can deactivate only; Admin/Super Admin can deactivate/reactivate
        if ($authUser->isManager() && $user->role !== 'cashier') {
            abort(403, 'Managers can only deactivate cashiers.');
        }

        if (!$authUser->isManager() && !$authUser->isAdmin() && !$authUser->isSuperAdmin()) {
            abort(403, 'You do not have permission to deactivate accounts.');
        }

        $oldValues = $user->toArray();
        $user->update(['is_active' => false]);
        $this->auditService->log('DEACTIVATE', 'users', $user->id, $oldValues, $user->toArray());

        return redirect()->route('users.index')->with('success', 'User deactivated successfully');
    }

    public function reactivate(User $user)
    {
        $authUser = auth()->user();

        // Only Admin and Super Admin can reactivate
        if (!$authUser->isAdmin() && !$authUser->isSuperAdmin()) {
            abort(403, 'You do not have permission to reactivate accounts.');
        }

        $oldValues = $user->toArray();
        $user->update(['is_active' => true]);
        $this->auditService->log('REACTIVATE', 'users', $user->id, $oldValues, $user->toArray());

        return redirect()->route('users.index')->with('success', 'User reactivated successfully');
    }

    public function destroy(User $user)
    {
        $authUser = auth()->user();

        // Only Admin or Super Admin can delete users
        if (!$authUser->isAdmin() && !$authUser->isSuperAdmin()) {
            abort(403, 'You do not have permission to delete accounts.');
        }

        $oldValues = $user->toArray();
        $user->delete();
        $this->auditService->log('DELETE', 'users', $user->id, $oldValues, []);

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
