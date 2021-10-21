<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkUserAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
       $age = (int)$user['age'];
       if($age >= 18) {
        return $next($request);
        }else {
            return redirect('users');
        }

    }
}
