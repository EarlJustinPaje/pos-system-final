<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Skip for super admin
        if (auth()->check() && auth()->user()->role === 'super_admin') {
            return $next($request);
        }

        // Get tenant from authenticated user
        if (auth()->check() && auth()->user()->tenant_id) {
            $tenant = Tenant::find(auth()->user()->tenant_id);

            if (!$tenant || !$tenant->isActive()) {
                auth()->logout();
                return redirect()->route('login')
                    ->withErrors(['error' => 'Your account or subscription is inactive.']);
            }

            // Store tenant in request
            $request->merge(['tenant' => $tenant]);
            app()->instance('tenant', $tenant);
        }

        return $next($request);
    }
}