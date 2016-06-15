<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ChercheurUTT
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
      if (Auth::check())
      {
        if($request->user()['relations']['equipe']['relations']['organisation']['attributes']['name'] == 'UTT')
        {
          return $next($request);
        }

      }
        return redirect('/'); // Normalement on devrait regiriger vers la liste des publications, par défaut je mets la page d'accueil temporaire
   
    }
}
