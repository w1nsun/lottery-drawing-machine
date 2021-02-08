<?php

namespace App\Entity;

use App\Repository\UserPrizeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserPrizeRepository::class)
 */
class UserPrize
{
    private const STATUS_NEW = 0;
    private const STATUS_ACTIVATED = 1;

    private const STATUSES_ENUM = [
        self::STATUS_NEW => 'new',
        self::STATUS_ACTIVATED => 'activated',
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Prize::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $prize;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"default" : 0})
     */
    private $status;

    public function __construct(User $user, Prize $prize)
    {
        $this->user = $user;
        $this->prize = $prize;
        $this->status = self::STATUS_NEW;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPrize(): ?Prize
    {
        return $this->prize;
    }

    public function setPrize(Prize $prize): self
    {
        $this->prize = $prize;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->prize->getTitle();
    }

    public function getReadableType(): string
    {
        return $this->prize->getReadableType();
    }

    public function activate(): self
    {
        $this->status = self::STATUS_ACTIVATED;

        return $this;
    }

    public function getReadableStatus(): string
    {
        return self::STATUSES_ENUM[$this->status];
    }
}
