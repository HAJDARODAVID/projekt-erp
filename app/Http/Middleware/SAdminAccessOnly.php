<?php

namespace App\Http\Middleware;

use App\Models\User\User;
use Closure;
use Illuminate\Http\Request;
use App\Models\User\UserType;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SAdminAccessOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::find(Auth::user()->id);
        if (!(UserType::init()->isUserSAdmin($user))) return redirect(route('home'))->withHeaders(['x-message' => 'User with type: ' . $user->user_type . ' can not access this route!']);
        return $next($request);
    }
}
