<?php

declare(strict_types=1);

namespace App\Partner\src\Entity;

use App\Partner\src\Repository\PartnerRepository;
use App\Base\src\Entity\{IdgenerationTrait, TimestampableTrait};
use Doctrine\ORM\Mapping\{Entity, Column, HasLifecycleCallbacks};

#[Entity(repositoryClass: PartnerRepository::class)]
#[HasLifecycleCallbacks]
class Partner
{
    use IdgenerationTrait;
    use TimestampableTrait;

    #[Column(name: 'partner_name', length: 255)]
    private ?string $name = null;

    #[Column(name: 'partner_key', length: 255, unique: true)]
    private ?string $key = null;

    #[Column(name: 'partner_secret', length: 255, unique: true)]
    private ?string $secret = null;

    #[Column(name: 'partner_wdpass', length: 255, nullable: true)]
    private ?string $wdpass = null;

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
     * Get the value of key
     *
     * @return ?string
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * Set the value of key
     *
     * @return self
     */
    public function setKey(?string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get the value of secret
     *
     * @return ?string
     */
    public function getSecret(): ?string
    {
        return $this->secret;
    }

    /**
     * Set the value of secret
     *
     * @return self
     */
    public function setSecret(?string $secret): self
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get the value of wdpass
     *
     * @return ?string
     */
    public function getWdpass(): ?string
    {
        return $this->wdpass;
    }

    /**
     * Set the value of wdpass
     *
     * @return self
     */
    public function setWdpass(?string $wdpass): self
    {
        $this->wdpass = openssl_encrypt($wdpass, 'aes-256-cbc', 'it/f}/|EP.*)$9', 0, 'DTY3AJ9ED6g2j7bR');

        return $this;
    }
}
