<?php

declare(strict_types=1);

namespace App\Balance\src\Entity;

use Doctrine\DBAL\Types\Types;
use App\Transaction\src\Entity\Operation;
use App\Balance\src\Repository\TaxRepository;
use App\Base\src\Entity\{IdgenerationTrait, TimestampableTrait};
use App\Partner\src\Entity\Partner;
use Doctrine\ORM\Mapping\{Entity, Column, ManyToOne, HasLifecycleCallbacks};

#[Entity(repositoryClass: TaxRepository::class)]
#[HasLifecycleCallbacks]
class Tax
{
    use IdgenerationTrait;
    use TimestampableTrait;

    #[ManyToOne(targetEntity: Partner::class, inversedBy: 'PartnerTax')]
    private ?Partner $partner = null;

    #[ManyToOne(targetEntity: Operation::class, inversedBy: 'OperationTax')]
    private ?Operation $operation = null;

    #[ManyToOne(targetEntity: Country::class, inversedBy: 'CountryTax')]
    private ?Country $country = null;

    #[Column(name: 'value', type: Types::DECIMAL, precision: 20, scale: 8)]
    private ?float $value = null;

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
     * Get the value of operation
     *
     * @return ?Operation
     */
    public function getOperation(): ?Operation
    {
        return $this->operation;
    }

    /**
     * Set the value of operation
     *
     * @return self
     */
    public function setOperation(?Operation $operation): self
    {
        $this->operation = $operation;

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

    /**
     * Get the value of value
     *
     * @return ?float
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return self
     */
    public function setValue(?float $value): self
    {
        $this->value = $value;

        return $this;
    }
}
