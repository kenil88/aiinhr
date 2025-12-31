<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCompanyUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(401, 'Unauthenticated.');
        }

        if ($user->role === 'admin') {
            abort(403, 'Admins cannot access company area.');
        }

        if ($user->company_id === null) {
            abort(403, 'Company access required.');
        }

        return $next($request);
    }
}
