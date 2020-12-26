<?php


namespace App\Model\User\Entity\User;


use Webmozart\Assert\Assert;

class Email
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $email)
    {
        Assert::notEmpty($email);
        Assert::email($email);
        $this->value = strtolower($email);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}