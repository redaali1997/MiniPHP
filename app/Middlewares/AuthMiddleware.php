<?php

namespace App\Middlewares;

use App\Interfaces\MiddlewareInterface;
use Closure;

class AuthMiddleware
{
    public function handle($request, Closure $next)
    {
        echo "🛡️ جاري التحقق من الهوية...<br>";

        // محاكاة فحص (هنفترض إنه أدمن)
        $is_admin = true;

        if (!$is_admin) {
            echo "⛔ ممنوع الدخول!";
            exit; // قطع السلسلة
        }

        // كمل يا بطل
        return $next($request);
    }
}