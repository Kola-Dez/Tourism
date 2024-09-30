<?php

namespace App\Http\Middleware;

use App\Models\Language\Language;
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
        $locale = $request->header('Accept-Language', 'en');
        $locale = strtolower(substr($locale, 0, 2));

        $availableLocales = Language::pluck('code')->toArray();

        if (in_array($locale, $availableLocales)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
