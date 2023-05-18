<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SlackChallengeResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('challenge')) {
            return response($request->input('challenge'));
        }

        return $next($request);
    }
}
