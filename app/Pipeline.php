<?php

namespace App;

use Closure;

class Pipeline
{
    protected $passable;

    protected array $pipes = [];

    public function send($passable) {
        $this->passable = $passable;
        return $this;
    }

    public function through(array $pipes) {
        $this->pipes = $pipes;
        return $this;
    }

    public function then(Closure $destination) {
        $pipeline = array_reduce(
            array_reverse($this->pipes),
            function ($stack, $pipe) {
                return function ($passable) use ($pipe, $stack) {
                    return (new $pipe)->handle($passable, $stack);
                };
            },
            $destination
        );

        return $pipeline($this->passable);
    }
}