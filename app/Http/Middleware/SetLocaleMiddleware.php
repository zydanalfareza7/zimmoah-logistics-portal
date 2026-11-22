<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    public const SUPPORTED_LOCALES = ['id', 'en', 'ko'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', 'id');

        if (! in_array($locale, self::SUPPORTED_LOCALES, true)) {
            $locale = 'id';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
