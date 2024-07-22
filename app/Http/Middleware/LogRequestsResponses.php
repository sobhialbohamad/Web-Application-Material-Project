<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\RequestLog;
class LogRequestsResponses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle($request, Closure $next)
 {
     // Continue processing the request
     $response = $next($request);

     // Create a new log entry
     $log = new RequestLog();

     // Log request details
     $log->request = json_encode([
         'headers' => $request->headers->all(),
         'body'    => $request->all(),
     ]);

     // Log response details, truncated to fit the column length
     $log->response = substr($response->getContent(), 0, 65535);

     // Save the log
     $log->save();

     // Return the response
     return $response;
 }

}
