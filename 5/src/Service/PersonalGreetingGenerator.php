<?php

namespace App\Service;

class PersonalGreetingGenerator
{
    public function __construct(private GreetingGenerator $greetingGenerator)
    {
    }

    public function generate(array $users): array
    {
        $result = [];

        foreach ($users as $user) {
            $result[] = [
                'name' => $user['name'],
                'email' => $user['email'],
                'greeting' => $this->greetingGenerator->generate($user['name']),
            ];
        }

        return $result;
    }
}
