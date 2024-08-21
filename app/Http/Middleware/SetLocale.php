<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Обработать входящий запрос.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->header('Accept-Language');
        $locale = strtolower(substr($locale, 0, 2));

        if (in_array($locale, ['en', 'ru', 'kg', 'kz', 'tj', 'tm', 'uz'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
