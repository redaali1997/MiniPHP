<?php
namespace App\Interfaces;

interface MiddlewareInterface
{
    public function handle($request, \Closure $next);
}