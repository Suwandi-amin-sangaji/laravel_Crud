<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Petugas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kondisi jika rolenya adalah petugas
        if (auth()->user()->role === 'petugas') {
            return $next($request);
        }
        abort(403, 'Halaman Khusus Petugas Bro');

    }
}
