<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiAuthorization
{
    public function handle(Request $request, $next) {
        // @todo - uncomment to enable auth.
        /*
        $expectedToken = "Bearer 3C2B19E2946893CBE1AA14A7023867DAFDA0D4F1EEA9D4FF9C54EB4D09074C2B";
        $authHeader = $request->header('Authorization');
        if (empty($authHeader) || $authHeader != $expectedToken) {
            return new Response(["error" => "🚨 Invalid authorization token."], 401, [
                "content-type" => "application/json"
            ]);
        }
        */

        return $next($request);
    }
}