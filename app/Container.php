<?php
namespace App;

use ReflectionClass;

class Container
{
    private array $bindings = [];

    public function bind($interface, $implementation) {
        $this->bindings[$interface] = $implementation;
    }

    public function get(string $className)
    {
        if(isset($this->bindings[$className])) {
            $className = $this->bindings[$className];
        }
        
        // HomeController(User $user, int $name = 0)
        $reflector = new ReflectionClass($className);

        if (!$reflector->isInstantiable()) {
            throw new \Exception("Class [$className] is not instantiable.");
        }

        $constructor = $reflector->getConstructor();
        
        if (is_null($constructor)) {
            return new $className;
        }

        $parameters = $constructor->getParameters();
        
        $dependencies = [];
        foreach($parameters as $parameter) {
            $type = $parameter->getType();
            if($type && !$type->isBuiltin()) {
                $dependencies[] = $this->get($type->getName());
            } else {
                if($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new \Exception("Cannot resolve parameter {$parameter->getName()}");
                }
            }
        }

        return $reflector->newInstanceArgs($dependencies);
    }
}