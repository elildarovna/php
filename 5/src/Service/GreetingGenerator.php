<?php

namespace App\Service;

class GreetingGenerator
{
    public function generate(string $name): string
    {
        return "Здравствуйте, {$name}!";
    }
}
