<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CampaignParameter
{
    public function handle(Request $request, Closure $next)
    {
      
        // Check if 'cid' parameter exists in the request
        if ($request->has('cid')) {
            session(['campId' => $request->input('cid')]);  
        }
       

        // Continue with the request
        return $next($request);
    }
}
