<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Log the login activity
            try {
                Activity::create([
                    'user_id' => Auth::id(),
                    'action' => 'logged_in',
                    'description' => Auth::user()->name . ' logged into the admin panel',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            } catch (\Exception $e) {
                // Log error but don't break the login flow
                \Log::error('Failed to log login activity: ' . $e->getMessage());
            }
            
            // Return JSON for AJAX requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'redirect' => route('admin.dashboard')
                ]);
            }
            
            return redirect()->route('admin.dashboard');
        }

        // Return JSON for AJAX requests
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'email' => ['The provided credentials do not match our records.']
                ]
            ], 422);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Log the logout activity before logging out
        if (Auth::check()) {
            try {
                Activity::create([
                    'user_id' => Auth::id(),
                    'action' => 'logged_out',
                    'description' => Auth::user()->name . ' logged out of the admin panel',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            } catch (\Exception $e) {
                // Log error but don't break the logout flow
                \Log::error('Failed to log logout activity: ' . $e->getMessage());
            }
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
} 