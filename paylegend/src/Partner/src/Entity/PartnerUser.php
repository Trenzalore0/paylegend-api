<?php

declare(strict_types=1);

namespace App\Partner\src\Entity;

use App\Partner\src\Entity\{Partner, Role};
use App\Partner\src\Repository\PartnerUserRepository;
use App\Base\src\Entity\{IdgenerationTrait, TimestampableTrait};
use Doctrine\ORM\Mapping\{Entity, Column, ManyToOne, HasLifecycleCallbacks};

#[Entity(repositoryClass: PartnerUserRepository::class)]
#[HasLifecycleCallbacks]
class PartnerUser
{
    use IdgenerationTrait;
    use TimestampableTrait;

    #[ManyToOne(targetEntity: Partner::class, inversedBy: 'partnerUsers')]
    private Partner $partner;

    #[ManyToOne(targetEntity: Role::class, inversedBy: 'partnerUsers')]
    private Role $role;

    #[Column(length: 255)]
    private ?string $name = null;

    #[Column(length: 255, unique: true)]
    private ?string $email = null;

    #[Column(length: 255)]
    private ?string $password = null;

    /**
     * Get the value of partner
     *
     * @return ?Partner
     */
    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    /**
     * Set the value of partner
     *
     * @return self
     */
    public function setPartner(?Partner $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * Get the value of role
     *
     * @return ?Role
     */
    public function getRole(): ?Role
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return self
     */
    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

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
     * Get the value of email
     *
     * @return ?string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return self
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return ?string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return self
     */
    public function setPassword(?string $password): self
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }
}
