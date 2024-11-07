<?php

declare(strict_types=1);

namespace App\Transaction\src\Entity;

use App\Partner\src\Entity\Partner;
use App\Transaction\src\Repository\TransactionRepository;
use App\Base\src\Entity\{IdgenerationTrait, TimestampableTrait};
use Doctrine\ORM\Mapping\{Entity, Column, ManyToOne, HasLifecycleCallbacks};

#[Entity(repositoryClass: TransactionRepository::class)]
#[HasLifecycleCallbacks]
class TransactionEntity
{
    use IdgenerationTrait;
    use TimestampableTrait;

    #[Column(length: 255)]
    private ?string $txId = null;

    #[Column(length: 255)]
    private ?string $e2eId = null;

    #[Column(length: 255, unique: true)]
    private ?string $number = null;

    #[ManyToOne(targetEntity: Operation::class, inversedBy: 'TransactionEntityOperations')]
    private ?Operation $operation = null;

    #[ManyToOne(targetEntity: Status::class, inversedBy: 'TransactionEntityStatus')]
    private ?Status $status = null;

    #[ManyToOne(targetEntity: Partner::class, inversedBy: 'TransactionEntityPartner')]
    private ?Partner $partner = null;

    /**
     * Get the value of txId
     *
     * @return ?string
     */
    public function getTxId(): ?string
    {
        return $this->txId;
    }

    /**
     * Set the value of txId
     *
     * @return self
     */
    public function setTxId(?string $txId): self
    {
        $this->txId = $txId;

        return $this;
    }

    /**
     * Get the value of e2eId
     *
     * @return ?string
     */
    public function getE2eId(): ?string
    {
        return $this->e2eId;
    }

    /**
     * Set the value of e2eId
     *
     * @return self
     */
    public function setE2eId(?string $e2eId)
    {
        $this->e2eId = $e2eId;

        return $this;
    }

    /**
     * Get the value of number
     *
     * @return ?string
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return self
     */
    public function setNumber(?string $number): self
    {
        $this->number = $number;

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
     * Get the value of status
     *
     * @return ?Status
     */
    public function getStatus(): ?Status
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return self
     */
    public function setStatus(?Status $status): self
    {
        $this->status = $status;

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
