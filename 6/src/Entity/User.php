<?php

namespace App\Entity;

use App\Validator\StrongPassword;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'app_user')]
#[UniqueEntity(fields: ['email'], message: 'Этот email уже зарегистрирован.')]
#[StrongPassword]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private string $email = '';

    #[ORM\Column(length: 30)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 30)]
    #[Assert\Regex(pattern: '/^[\p{L}-]+$/u', message: 'Имя может содержать только буквы и дефисы.')]
    private string $name = '';

    #[ORM\Column]
    private string $password = '';

    #[Assert\NotBlank]
    #[Assert\Length(min: 8)]
    private ?string $plainPassword = null;

    public function getId(): ?int { return $this->id; }
    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }
    public function getName(): string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }
    public function getPassword(): string { return $this->password; }
    public function setPassword(string $password): static { $this->password = $password; return $this; }
    public function getPlainPassword(): ?string { return $this->plainPassword; }
    public function setPlainPassword(?string $password): static { $this->plainPassword = $password; return $this; }
    public function getRoles(): array { return ['ROLE_USER']; }
    public function getUserIdentifier(): string { return $this->email; }
    public function eraseCredentials(): void { $this->plainPassword = null; }
}
