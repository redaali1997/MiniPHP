<?php

namespace App\Middlewares;

use App\Interfaces\MiddlewareInterface;
use Closure;

class TrimStrings
{
    public function handle($request, Closure $next)
    {
        echo "🧹 جاري تنظيف النصوص...<br>";

        // محاكاة تنظيف الـ Request
        // في الواقع بنعدل $_POST
        array_walk_recursive($request, function (&$value) {
            $value = trim($value);
        });

        // سحر الـ Pipeline: مرر الشعلة للي بعدي
        return $next($request);
    }
}