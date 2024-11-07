<?php

declare(strict_types=1);

namespace App\Partner\src\Entity;

use App\Partner\src\Repository\WhiteListRepository;
use App\Base\src\Entity\{IdgenerationTrait, TimestampableTrait};
use Doctrine\ORM\Mapping\{Column, Entity, ManyToOne, HasLifecycleCallbacks};

#[Entity(repositoryClass: WhiteListRepository::class)]
#[HasLifecycleCallbacks]
class WhiteList
{
    use IdgenerationTrait;
    use TimestampableTrait;

    #[Column(name: 'ipAddress', length: 255)]
    private ?string $ipAddress = null;

    #[ManyToOne(targetEntity: Partner::class, inversedBy: 'partnerIps')]
    private ?Partner $partner = null;

    /**
     * Get the value of ipAddress
     *
     * @return ?string
     */
    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    /**
     * Set the value of ipAddress
     *
     * @return self
     */
    public function setIpAddress(?string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

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
}
