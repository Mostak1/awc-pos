<?php

namespace App\Http\Middleware;

use App\Models\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $users = UserRole::where('user_id', $user_id)->get();
            foreach ($users as $user) {
                if ($user->role_id == $role) {
                    return $next($request);
                }
            }
            abort(403, 'Unauthorize');
        }
        abort(403, 'Unauthorized');

    }
}
