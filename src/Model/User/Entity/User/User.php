<?php


namespace App\Model\User\Entity\User;


use DateTimeImmutable;

class User
{
    const STATUS_WAIT = 'wait';
    const STATUS_ACTIVE = 'active';

    /**
     * @var Id
     */
    private $id;
    /**
     * @var Email
     */
    private $email;
    /**
     * @var string
     */
    private $passwordHash;
    /**
     * @var DateTimeImmutable
     */
    private $createdAt;
    /**
     * @var string
     */
    private $token;
    /**
     * @var string
     */
    private $status;

    public function __construct(
        Id $id,
        Email $email,
        string $passwordHash,
        string $token,
        DateTimeImmutable $createdAt
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->createdAt = $createdAt;
        $this->token = $token;
        $this->status = self::STATUS_WAIT;
    }

    public function confirmSignUp(): void
    {
        if(!$this->isWait()) {
            throw new \Exception('User already confirmed.');
        }
        $this->status = self::STATUS_ACTIVE;
        $this->token = null;
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @param Email $email
     */
    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @param string $passwordHash
     */
    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }
}