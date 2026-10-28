<?php

namespace App\Validator;

use App\Entity\User;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class StrongPasswordValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$value instanceof User || !$value->getPlainPassword()) {
            return;
        }

        $password = $value->getPlainPassword();
        $sameChars = count(array_unique(mb_str_split($password))) === 1;
        $containsIdentity = str_contains(mb_strtolower($password), mb_strtolower($value->getName()))
            || str_contains(mb_strtolower($password), mb_strtolower($value->getEmail()));

        if (mb_strlen($password) < 8 || !preg_match('/\d.*\d/s', $password)
            || preg_match_all('/\p{L}/u', $password) < 3
            || !preg_match('/[^\p{L}\d]/u', $password)
            || $sameChars || $containsIdentity) {
            $this->context->buildViolation($constraint->message)->atPath('plainPassword')->addViolation();
        }
    }
}
