<?php

declare(strict_types=1);

namespace App\Transaction\src\Queue;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class RefundHandler
{
    public function __invoke(RefundMessage $notify)
    {
        dd($notify);
    }
}
