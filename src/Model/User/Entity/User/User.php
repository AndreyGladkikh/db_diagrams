<?php


namespace App\Model\User\Entity\User;


use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="user_users")
 */
class User implements UserInterface
{
    const STATUS_NEW = 'new';
    const STATUS_WAIT = 'wait';
    const STATUS_ACTIVE = 'active';

    /**
     * @var Id
     * @ORM\Column(type="user_user_id")
     * @ORM\Id()
     */
    private $id;
    /**
     * @var Name
     * @ORM\Embedded(class="Name", columnPrefix="name_")
     */
    private $name;
    /**
     * @var Email
     * @ORM\Column(type="user_user_email", nullable=true)
     */
    private $email;
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true, name="password_hash")
     */
    private $passwordHash;
    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", name="created_at")
     */
    private $createdAt;
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $confirmToken;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $status;
    /**
     * @var Network[]|ArrayCollection
     */
    private $networks;
    /**
     * @var ResetToken|null
     * @ORM\Embedded(class="ResetToken", columnPrefix="reset_token_")
     */
    private $resetToken;
    /**
     * @var Role
     * @ORM\Column(type="user_user_role")
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
        string $confirmToken
    ): void
    {
        if (!$this->isNew()) {
            throw new \Exception('User already signed up.');
        }
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->confirmToken = $confirmToken;
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
        $this->confirmToken = null;
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
    public function getConfirmToken(): ?string
    {
        return $this->confirmToken;
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

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @ORM\PostLoad()
     */
    public function checkEmbeds(): void
    {
        if($this->resetToken->isEmpty()) {
            $this->resetToken = null;
        }
    }

    public function getRoles()
    {
        return [$this->role->getValue()];
    }

    public function getPassword()
    {
        return $this->passwordHash;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->getEmail()->getValue();
    }

    public function eraseCredentials()
    {

    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }
}