<?php

declare(strict_types=1);

namespace App\Transaction\src\Queue;

class PayinMessage
{
    public function __construct(
        private ?string $content = null,
    ) {}

    public function getContent(): ?string
    {
        return $this->content;
    }
}
