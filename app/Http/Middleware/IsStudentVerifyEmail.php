<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsStudentVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('student')->user()->email_verified){
            Auth::guard('student')->logout();
            return redirect()->route('student.login')->with('fail','You need to confirm your account. We have sent you an activation link, please check your email')->withInput();
        }
        return $next($request);
    }
}
