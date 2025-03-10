<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant\Configuration;
use App\Helpers\UserControlHelper;


class LockedTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $configuration = Configuration::first();
        if(null === $configuration) {
            $configuration = new Configuration();
        }

        if($configuration->isLockedTenant()){
            abort(403);
        }

        UserControlHelper::checkActiveUser();

        return $next($request);
    }
}
