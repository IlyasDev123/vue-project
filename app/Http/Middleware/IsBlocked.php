<?php

namespace App\Http\Middleware;

use Closure;
use App\Utlities\Constants;
use Illuminate\Http\Request;

class IsBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if ($user->is_blocked == Constants::BLOCKED_USER) {
            $user->token()->revoke();
            return sendError('Your account has been blocked. Please contact with customer support.', null, 403);
        }
        return $next($request);
    }
}
