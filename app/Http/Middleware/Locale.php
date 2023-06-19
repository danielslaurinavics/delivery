<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Locale
{
    public function handle(Request $request, Closure $next): Response
    {
        App::setLocale(session('locale', config('app.locale')));
		
		return $next($request);
    }
}
