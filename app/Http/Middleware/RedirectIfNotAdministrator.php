<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectIfNotAdministrator {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
            if (Auth::check() && !$request->user()->isAdministrator() || !Auth::check()) {
                return redirect()->back();
            }

		return $next($request);
	}

}
