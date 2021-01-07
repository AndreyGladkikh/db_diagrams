<?php


namespace App\Model\User\Entity\User;


use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;

class User
{
    const STATUS_NEW = 'new';
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
    /**
     * @var Network[]|ArrayCollection
     */
    private $networks;
    /**
     * @var ResetToken|null
     */
    private $resetToken;
    /**
     * @var Role
     */
    private $role;

    public function __construct(
        Id $id,
        DateTimeImmutable $createdAt
    )
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->status = self::STATUS_NEW;
        $this->networks = new ArrayCollection();
        $this->role = Role::user();
    }

    public function signUpByEmail(
        Email $email,
        string $passwordHash,
        string $token
    ): void
    {
        if (!$this->isNew()) {
            throw new \Exception('User already signed up.');
        }
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->token = $token;
        $this->status = self::STATUS_WAIT;
    }

    public function signUpByNetwork(
        string $network,
        string $identity
    ): void
    {
        if (!$this->isNew()) {
            throw new \Exception('User already signed up.');
        }
        $this->attachNetwork($network, $identity);
        $this->status = self::STATUS_ACTIVE;
    }

    public function confirmSignUp(): void
    {
        if (!$this->isWait()) {
            throw new \Exception('User already confirmed.');
        }
        $this->status = self::STATUS_ACTIVE;
        $this->token = null;
    }

    public function isNew(): bool
    {
        return $this->status === self::STATUS_NEW;
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function requestPasswordReset(ResetToken $resetToken, DateTimeImmutable $date)
    {
        if (!$this->email) {
            throw new \Exception('Email is not specified.');
        }
        if($this->resetToken && !$this->resetToken->isExpiredTo($date)) {
            throw new \Exception('Resetting is already requested.');
        }
        $this->resetToken = $resetToken;
    }

    public function resetPassword(DateTimeImmutable $date, string $passwordHash): void
    {
        if(!$this->resetToken) {
            throw new \Exception('Resetting is not requested.');
        }
        if($this->resetToken->isExpiredTo($date)) {
            throw new \Exception('Reset token is expired.');
        }
        $this->passwordHash = $passwordHash;
    }

    public function attachNetwork(string $network, string $identity)
    {
        foreach ($this->networks as $existing) {
            if ($existing->isForNetwork($network)) {
                throw new \Exception('Network is already attached');
            }
        }
        $this->networks->add(new Network($this, $network, $identity));
    }

    public function changeRole(Role $role)
    {
        if($this->role->isEqual($role)) {
            throw new \Exception('Role is already the same.');
        }
        $this->role = $role;
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

    /**
     * @return array
     */
    public function getNetworks(): array
    {
        return $this->networks->toArray();
    }

    /**
     * @return ResetToken|null
     */
    public function getResetToken(): ?ResetToken
    {
        return $this->resetToken;
    }
}