<?php

declare(strict_types=1);

namespace App\Transaction\src\Entity;

use App\Transaction\src\Repository\StatusRepository;
use App\Base\src\Entity\{IdgenerationTrait, TimestampableTrait};
use Doctrine\ORM\Mapping\{Entity, Column, HasLifecycleCallbacks};

#[Entity(repositoryClass: StatusRepository::class)]
#[HasLifecycleCallbacks]
class Status
{
    use IdgenerationTrait;
    use TimestampableTrait;

    #[Column(length: 255)]
    private ?string $name = null;

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
}
