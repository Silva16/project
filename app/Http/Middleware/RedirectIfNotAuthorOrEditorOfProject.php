<?php namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Project;

class RedirectIfNotAuthorOrEditorOfProject
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

                $projects = Project::where('created_by', '=', Auth::user()->id)->get();

                foreach ($projects as $project) {
                    if ($project->id == $request->id) {
                        return $next($request);
                    }
                }
            }

            elseif ($request->user()->isEditor()){

                return $next($request);
            }

            return redirect()->back();
        }

        return $next($request);
    }

}
