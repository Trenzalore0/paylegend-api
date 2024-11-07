<?php

declare(strict_types=1);

namespace App\Partner\src\Entity;

use App\Partner\src\Repository\RoleRepository;
use App\Base\src\Entity\{IdgenerationTrait, TimestampableTrait};
use Doctrine\ORM\Mapping\{Entity, Column, HasLifecycleCallbacks};

#[Entity(repositoryClass: RoleRepository::class)]
#[HasLifecycleCallbacks]
class Role
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
