<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsGetOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('GET') || $request->isMethod('POST')) {

            $response = $next($request);
            // $response->headers->set('Access-Control-Allow-Origin', 'https://gianpierovasquez.cloud');
            $response->headers->set('Access-Control-Allow-Methods', 'GET,POST');
            // $response->headers->set('Access-Control-Allow-Headers', 'asdadada-adadad');
            return $response;
        }

        return response()->json(['error' => 'Metodos no autorizados'], 405);   
    }
}
