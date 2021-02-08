<?php

namespace App\Entity;

use App\Repository\PrizeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrizeRepository::class)
 */
class Prize
{
    public const TYPE_REAL = 1;
    public const TYPE_MONEY = 2;
    public const TYPE_BONUSES = 3;

    private const TYPES_ENUM = [
        self::TYPE_REAL => 'real',
        self::TYPE_MONEY => 'money',
        self::TYPE_BONUSES => 'bonuses',
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minSum;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxSum;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        if (!array_key_exists($type, self::TYPES_ENUM)) {
            throw new \InvalidArgumentException(sprintf('Invalid prize type. See: %s', __CLASS__));
        }

        $this->type = $type;

        return $this;
    }

    public function getMinSum(): ?int
    {
        return $this->minSum;
    }

    public function setMinSum(?int $minSum): self
    {
        if ($minSum <= 0) {
            throw new \InvalidArgumentException('Min sum must be greater then 0');
        }

        if (null !== $this->getMaxSum() && $this->getMaxSum() < $minSum) {
            throw new \InvalidArgumentException('Min sum must be less then max sum');
        }

        $this->minSum = $minSum;

        return $this;
    }

    public function getMaxSum(): ?int
    {
        return $this->maxSum;
    }

    public function setMaxSum(?int $maxSum): self
    {
        if ($maxSum <= 0) {
            throw new \InvalidArgumentException('Min sum must be greater then 0');
        }

        if (null !== $this->getMinSum() && $this->getMinSum() > $maxSum) {
            throw new \InvalidArgumentException('Max sum must be greater then min sum');
        }

        $this->maxSum = $maxSum;

        return $this;
    }
}
