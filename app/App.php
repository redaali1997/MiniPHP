<?php
namespace App;

class App
{
    private static $container;

    public static function setContainer(Container $container)
    {
        self::$container = $container;
    }

    public static function container(): Container
    {
        return self::$container;
    }
}