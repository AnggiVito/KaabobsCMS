<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MenuRoleMapping;

class ValidateMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request
     * @param  \Closure 
     * @param  string
     * @param  string
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $menuId, $requiredAction)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $role = Auth::user()->role;

        $hasPermission = MenuRoleMapping::where('code_role', $role)
            ->where('id_menu', $menuId)
            ->where('action', 'LIKE', '%' . $requiredAction . '%')
            ->exists();

        if ($hasPermission) {
            return $next($request);
        }
        return response()->json(['code' => '403', 'message' => 'Access Denied'], 403);
    }
}