<?php

namespace App\Http\Middleware;

use App\Models\file;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFileAvailability
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

      $filename = $request->route('filename'); // Correctly retrieve the filename parameter
       $file = file::where('filename', $filename)->first();

      if (!$file) {
            abort(404, 'File not found');
        }

        // Check if the file is free
        elseif ($file->status === 'free') {
            return $next($request);
        }
      else{
        return redirect()->back();
}
        // File is not free, handle accordingly (e.g., redirect or respond with an error)


        // Alternatively, you can return a JSON response if your application uses APIs
        // return response()->json(['error' => 'This file is not available for reservation.'], 403);
    }
}
