<?php

declare(strict_types=1);

namespace App\Transaction\src\Entity;

use App\Base\src\Entity\IdgenerationTrait;
use Doctrine\ORM\Mapping\{Entity, Column, ManyToOne, HasLifecycleCallbacks};

#[Entity]
#[HasLifecycleCallbacks]
class TransactionValueString
{
    use IdgenerationTrait;

    #[ManyToOne(
        targetEntity: TransactionEntity::class,
        inversedBy: 'TransactionEntityTransactionValuesString'
    )]
    private ?TransactionEntity $transactionEntity = null;

    #[ManyToOne(
        targetEntity: TransactionAttribute::class,
        inversedBy: 'TransactionAttributeTransactionValuesString'
    )]
    private ?TransactionAttribute $transactionAttribute = null;

    #[Column(length: 255)]
    private ?string $value = null;

    /**
     * Get the value of transactionEntity
     *
     * @return ?TransactionEntity
     */
    public function getTransactionEntity(): ?TransactionEntity
    {
        return $this->transactionEntity;
    }

    /**
     * Set the value of transactionEntity
     *
     * @return self
     */
    public function setTransactionEntity(?TransactionEntity $transactionEntity): self
    {
        $this->transactionEntity = $transactionEntity;

        return $this;
    }

    /**
     * Get the value of transactionAttribute
     *
     * @return ?TransactionAttribute
     */
    public function getTransactionAttribute(): ?TransactionAttribute
    {
        return $this->transactionAttribute;
    }

    /**
     * Set the value of transactionAttribute
     *
     * @return self
     */
    public function setTransactionAttribute(?TransactionAttribute $transactionAttribute): self
    {
        $this->transactionAttribute = $transactionAttribute;

        return $this;
    }

    /**
     * Get the value of value
     *
     * @return ?string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return self
     */
    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
