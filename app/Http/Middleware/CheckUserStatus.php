<?php

namespace App\Http\Middleware;

use App\Models\MerchantProfile;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login, izinkan proses berjalan
        if (!Auth::check()) {
            return $next($request);
        }

        // Jika user sudah login, periksa statusnya
        if (Auth::user()->status !== 'APPROVE') {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Your account is not approved yet. Please contact the admin.',
            ]);
        }
        return $next($request);
    }
}
