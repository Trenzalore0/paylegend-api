<?php

declare(strict_types=1);

namespace App\Balance\src\Entity;

use Doctrine\DBAL\Types\Types;
use App\Transaction\src\Entity\Operation;
use App\Balance\src\Repository\FeeRepository;
use App\Base\src\Entity\{IdgenerationTrait, TimestampableTrait};
use App\Partner\src\Entity\Partner;
use Doctrine\ORM\Mapping\{Entity, Column, ManyToOne, HasLifecycleCallbacks};

#[Entity(repositoryClass: FeeRepository::class)]
#[HasLifecycleCallbacks]
class Fee
{
    use IdgenerationTrait;
    use TimestampableTrait;

    #[ManyToOne(targetEntity: Partner::class, inversedBy: 'PartnerFee')]
    private ?Partner $partner = null;

    #[ManyToOne(targetEntity: Operation::class, inversedBy: 'OperationFee')]
    private ?Operation $operation = null;

    #[Column(name: 'fee', type: Types::DECIMAL, precision: 20, scale: 8)]
    private ?float $fee = null;

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
     * Get the value of fee
     *
     * @return ?float
     */
    public function getFee(): ?float
    {
        return $this->fee;
    }

    /**
     * Set the value of fee
     *
     * @return self
     */
    public function setFee(?float $fee): self
    {
        $this->fee = $fee;

        return $this;
    }
}
