<?php

declare(strict_types=1);

namespace App\Transaction\src\Entity;

use App\Base\src\Entity\{IdgenerationTrait, TimestampableTrait};
use Doctrine\ORM\Mapping\{Entity, Column, HasLifecycleCallbacks};
use App\Transaction\src\Repository\TransactionAttributeRepository;

#[Entity(repositoryClass: TransactionAttributeRepository::class)]
#[HasLifecycleCallbacks]
class TransactionAttribute
{
    use IdgenerationTrait;
    use TimestampableTrait;

    #[Column(length: 255, unique: true)]
    private ?string $name = null;

    #[Column(length: 255)]
    private ?string $type = null;

    /**
     * Get the value of name
     *
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of type
     *
     * @return ?string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return self
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
