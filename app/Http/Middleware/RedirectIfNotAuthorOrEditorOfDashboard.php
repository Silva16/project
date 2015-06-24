<?php namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Project;

class RedirectIfNotAuthorOrEditorOfDashboard
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
        if (Auth::check()) {

            if ($request->user()->isAuthor()) {

                return $next($request);

            } elseif ($request->user()->isEditor()){
                return $next($request);
            } else{
                return redirect()->back();
            }
        }

        return redirect()->back();
    }

}
