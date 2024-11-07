<?php

declare(strict_types=1);

namespace App\Transaction\src\Queue;

use App\Balance\src\Repository\BalanceRepository;
use App\Partner\src\Repository\PartnerRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class PayinHandler
{
    public function __construct(
        private ?BalanceRepository $balanceRepository = null,
        private ?PartnerRepository $partnerRepository = null
    ) {
    }

    public function __invoke(PayinMessage $notify)
    {
        $jsonReceiver = json_decode($notify->getContent(), true);
        dd($jsonReceiver, 'test do handler');

        


    }
}
