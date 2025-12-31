<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureCompanyIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role === 'admin') {
            return $next($request);
        }



        if ($user && $user->company && !$user->company->is_active) {
            Auth::logout();

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Your company account has been disabled. Please contact support.',
                ]);
        }

        return $next($request);
    }
}
