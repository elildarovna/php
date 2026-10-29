<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_CLASS)]
class StrongPassword extends Constraint
{
    public string $message = 'Пароль должен содержать не менее 2 цифр, 3 букв и 1 спецсимвола, не повторять имя или email и не состоять из одинаковых символов.';
}
