<?php


namespace App\Model\User\Entity\User;


use Webmozart\Assert\Assert;

class Role
{
    const ADMIN = 'ROLE_ADMIN';
    const USER = 'ROLE_USER';

    private $value;

    public function __construct(string $role)
    {
        Assert::oneOf($role, [
            self::ADMIN,
            self::USER
        ]);
        $this->value = $role;
    }

    public static function admin(): self
    {
        return new self(self::ADMIN);
    }

    public static function user(): self
    {
        return new self(self::USER);
    }

    public function isAdmin(): bool
    {
        return $this->value === self::ADMIN;
    }

    public function isUser(): bool
    {
        return $this->value === self::USER;
    }

    public function isEqual(self $role): bool
    {
        return $this->getValue() === $role->getValue();
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}