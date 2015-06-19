<?php namespace App\Http\Middleware;

use Auth;
use Closure;

class Author
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !$request->user()->isAuthorOrEditor() || !Auth::check()) {
            return redirect()->back();
        }

        return $next($request);
    }

}
