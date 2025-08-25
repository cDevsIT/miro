<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('customer')->check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            
            $returnUrl = $request->path();
            return redirect()->route('mymiro.login', ['returnUrl' => $returnUrl]);
        }

        return $next($request);
    }
} 