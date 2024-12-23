<?php

namespace App\Http\Middleware;


use Symfony\Component\HttpFoundation\Cookie;
use Carbon\Carbon;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // 
        //'testimonials/*',
        //'admin/testimonials/*',
    ];

    protected function addCookieToResponse($request, $response){
        $config = config('session');
        $response->headers->setCookie(new Cookie('XSRF-TOKEN', $request->session()->token(), $this->availableAt(60 * $config['lifetime']),
            $config['path'], $config['domain'], $config['secure'], true, true, $config['same_site'] ?? null));

        return $response;
    }
}
