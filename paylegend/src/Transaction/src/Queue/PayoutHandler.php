<?php

declare(strict_types=1);

namespace App\Transaction\src\Queue;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class PayoutHandler
{
    public function __invoke(PayoutMessage $notify)
    {
        dd($notify);
    }
}
