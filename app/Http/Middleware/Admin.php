<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if ($request->user()->admin)
      {
        return $next($request);
      }
      return redirect()->back(); // Normalement on devrait regiriger vers la liste des publications, par défaut je mets la page d'accueil temporaire
    }
}
