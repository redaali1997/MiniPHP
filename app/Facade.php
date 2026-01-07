<?php
namespace App;

abstract class Facade
{
    abstract protected static function getFacadeAccessor();

    public static function __callStatic($method, $args)
    {
        $key = static::getFacadeAccessor();

        $instance = App::container()->get($key);

        return $instance->$method(...$args);
    }
}