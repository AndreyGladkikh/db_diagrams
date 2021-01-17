<?php


namespace App\Model\User\Entity\User;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Name
{
    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private $last;
    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private $first;
    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private $middle;

    public function __construct(?string $last, ?string $first, ?string $middle)
    {
        $this->last = $last;
        $this->first = $first;
        $this->middle = $middle;
    }

    /**
     * @return string|null
     */
    public function getLast(): ?string
    {
        return $this->last;
    }

    /**
     * @return string|null
     */
    public function getFirst(): ?string
    {
        return $this->first;
    }

    /**
     * @return string|null
     */
    public function getMiddle(): ?string
    {
        return $this->middle;
    }

    public function getFull()
    {
        return trim($this->last . ' ' . $this->first . ' ' . $this->middle);
    }
}