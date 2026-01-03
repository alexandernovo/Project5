<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class GuestMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()) {
            if ($request->isMethod('get')) {
                return redirect('/dashboard');
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Redirect Access For Get Only',
                ], 200);
            }
        }

        return $next($request);
    }
}
