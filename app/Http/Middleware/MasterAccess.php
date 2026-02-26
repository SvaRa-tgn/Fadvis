<?php

namespace App\Http\Middleware;

use App\Enum\UserRoles;
use App\Exceptions\ErrorException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class MasterAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role !== UserRoles::MASTER) {
            return redirect()->route('main');
        }

        return $next($request);
    }
}
