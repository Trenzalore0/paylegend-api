<?php

declare(strict_types=1);

namespace App\Balance\src\Entity;

use App\Balance\src\Repository\CountryRepository;
use App\Base\src\Entity\{IdgenerationTrait, TimestampableTrait};
use Doctrine\ORM\Mapping\{Entity, Column, HasLifecycleCallbacks};

#[Entity(repositoryClass: CountryRepository::class)]
#[HasLifecycleCallbacks]
class Country
{
    use IdgenerationTrait;
    use TimestampableTrait;

    #[Column(name: 'country_name', length: 255)]
    private ?string $name = null;

    #[Column(name: 'country_acronym', length: 4)]
    private ?string $acronym = null;

    #[Column(name: 'country_currency', length: 6)]
    private ?string $currency = null;

    #[Column(name: 'country_currency_acronym', length: 4)]
    private ?string $currencyAcronym = null;

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
     * Get the value of acronym
     *
     * @return ?string
     */
    public function getAcronym(): ?string
    {
        return $this->acronym;
    }

    /**
     * Set the value of acronym
     *
     * @return self
     */
    public function setAcronym(?string $acronym): self
    {
        $this->acronym = $acronym;

        return $this;
    }

    /**
     * Get the value of currency
     *
     * @return ?string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * Set the value of currency
     *
     * @return self
     */
    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get the value of currencyAcronym
     *
     * @return ?string
     */
    public function getCurrencyAcronym(): ?string
    {
        return $this->currencyAcronym;
    }

    /**
     * Set the value of currencyAcronym
     *
     * @return self
     */
    public function setCurrencyAcronym(?string $currencyAcronym): self
    {
        $this->currencyAcronym = $currencyAcronym;

        return $this;
    }
}
