<?php

declare(strict_types=1);

namespace App\Balance\src\Entity;

use Doctrine\DBAL\Types\Types;
use App\Transaction\src\Entity\Operation;
use App\Balance\src\Repository\BalanceHistoryRepository;
use App\Base\src\Entity\{IdgenerationTrait, TimestampableTrait};
use Doctrine\ORM\Mapping\{Entity, Column, ManyToOne, HasLifecycleCallbacks};

#[Entity(repositoryClass: BalanceHistoryRepository::class)]
#[HasLifecycleCallbacks]
class BalanceHistory
{
    use IdgenerationTrait;
    use TimestampableTrait;

    #[ManyToOne(targetEntity: Balance::class, inversedBy: 'BalanceHistory')]
    private ?Balance $balance = null;

    #[ManyToOne(targetEntity: Operation::class, inversedBy: 'OperationHistory')]
    private ?Operation $operation = null;

    #[Column(type: Types::DECIMAL, precision: 20, scale: 8)]
    private ?float $previusAmount = null;

    #[Column(type: Types::DECIMAL, precision: 20, scale: 8)]
    private ?float $discountedFee = null;

    #[Column(type: Types::DECIMAL, precision: 20, scale: 8)]
    private ?float $discountedTax = null;

    #[Column(type: Types::DECIMAL, precision: 20, scale: 8)]
    private ?float $discountedRate = null;

    #[Column(type: Types::DECIMAL, precision: 20, scale: 8)]
    private ?float $amount = null;

    #[Column(type: Types::DECIMAL, precision: 20, scale: 8)]
    private ?float $amountWithDiscount = null;

    /**
     * Get the value of balance
     *
     * @return ?Balance
     */
    public function getBalance(): ?Balance
    {
        return $this->balance;
    }

    /**
     * Set the value of balance
     *
     * @return self
     */
    public function setBalance(?Balance $balance): self
    {
        $this->balance = $balance;

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
     * Get the value of previusAmount
     *
     * @return ?float
     */
    public function getPreviusAmount(): ?float
    {
        return $this->previusAmount;
    }

    /**
     * Set the value of previusAmount
     *
     * @return self
     */
    public function setPreviusAmount(?float $previusAmount): self
    {
        $this->previusAmount = $previusAmount;

        return $this;
    }

    /**
     * Get the value of discountedFee
     *
     * @return ?float
     */
    public function getDiscountedFee(): ?float
    {
        return $this->discountedFee;
    }

    /**
     * Set the value of discountedFee
     *
     * @return self
     */
    public function setDiscountedFee(?float $discountedFee): self
    {
        $this->discountedFee = $discountedFee;

        return $this;
    }

    /**
     * Get the value of discountedTax
     *
     * @return ?float
     */
    public function getDiscountedTax(): ?float
    {
        return $this->discountedTax;
    }

    /**
     * Set the value of discountedTax
     *
     * @return self
     */
    public function setDiscountedTax(?float $discountedTax): self
    {
        $this->discountedTax = $discountedTax;

        return $this;
    }

    /**
     * Get the value of discountedRate
     *
     * @return ?float
     */
    public function getDiscountedRate(): ?float
    {
        return $this->discountedRate;
    }

    /**
     * Set the value of discountedRate
     *
     * @return self
     */
    public function setDiscountedRate(?float $discountedRate): self
    {
        $this->discountedRate = $discountedRate;

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
     * Get the value of amountWithDiscount
     *
     * @return ?float
     */
    public function getAmountWithDiscount(): ?float
    {
        return $this->amountWithDiscount;
    }

    /**
     * Set the value of amountWithDiscount
     *
     * @return self
     */
    public function setAmountWithDiscount(?float $amountWithDiscount): self
    {
        $this->amountWithDiscount = $amountWithDiscount;

        return $this;
    }
}
