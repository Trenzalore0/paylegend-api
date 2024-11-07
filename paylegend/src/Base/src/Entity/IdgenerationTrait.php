<?php

declare(strict_types=1);

namespace App\Base\src\Entity;

use Doctrine\ORM\Mapping\{Id, GeneratedValue, Column};

trait IdgenerationTrait
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id = null;

    /**
     * Get the value of id
     *
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
