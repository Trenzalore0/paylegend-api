<?php

declare(strict_types=1);

namespace App\Balance\src\Entity;

use Doctrine\DBAL\Types\Types;
use App\Partner\src\Entity\Partner;
use App\Balance\src\Repository\BalanceRepository;
use App\Base\src\Entity\{IdgenerationTrait, TimestampableTrait};
use Doctrine\ORM\Mapping\{Entity, Column, ManyToOne, HasLifecycleCallbacks};

#[Entity(repositoryClass: BalanceRepository::class)]
#[HasLifecycleCallbacks]
class Balance
{
    use IdgenerationTrait;
    use TimestampableTrait;

    #[ManyToOne(targetEntity: Partner::class, inversedBy: 'PartnerBalance')]
    private ?Partner $partner = null;

    #[Column(type: Types::DECIMAL, precision: 20, scale: 8)]
    private ?float $amount = null;

    #[ManyToOne(targetEntity: Country::class, inversedBy: 'PartnerCountryBalance')]
    private ?Country $country = null;

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
     * Get the value of amount
     *
     * @return ?float
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return self
     */
    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of country
     *
     * @return ?Country
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return self
     */
    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }
}
