<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiVersion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $apiVersion): Response
    {
        $request->headers->set('Accept', 'application/vnd.task-manager-api.v{$apiVersion}+json');
        $request->headers->set('api_version', $apiVersion);
        return $next($request);
    }
}
