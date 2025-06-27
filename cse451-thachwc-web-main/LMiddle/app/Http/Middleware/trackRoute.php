<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class trackRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
	    $sessionCount = $request->session()->get('sessionCount', 0);
	    $pageCount = $request->session()->get('pageCount', 0);
	    $welcomeCount = $request->session()->get('welcomeCount', 0);
	    $helloCount = $request->session()->get('helloCount', 0);
	    $randomCount = $request->session()->get('randomCount', 0);

	    $sessionCount++;
	    $requestUrl = Request::capture()->fullUrl();
	    $stringArray =  explode('/', $requestUrl);
	    $currentroute = end($stringArray);
	    if($currentroute == 'hello') {
		$helloCount++;
	    }
	    else if($currentroute == 'random') {
		$randomCount++;
	    }
	    else if($currentroute == 'session') {
		$pageCount++;
	    }
	    else if($currentroute != 'log') {
		$welcomeCount++;
	    }
	    $request->session()->put('helloCount', $helloCount);
	    $request->session()->put('randomCount', $randomCount);
	    $request->session()->put('pageCount', $pageCount);
	    $request->session()->put('welcomeCount', $welcomeCount);
	    $request->session()->put('sessionCount', $sessionCount);
	    return $next($request);
    }
}
