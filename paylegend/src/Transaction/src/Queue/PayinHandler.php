<?php

declare(strict_types=1);

namespace App\Transaction\src\Queue;

use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Balance\src\Entity\BalanceHistory;
use App\Transaction\src\Entity\TransactionEntity;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use App\Balance\src\Repository\{FeeRepository, TaxRepository, BalanceRepository};
use App\Transaction\src\Repository\{StatusRepository, OperationRepository, TransactionRepository};

#[AsMessageHandler]
class PayinHandler
{
    public function __construct(
        private ?LoggerInterface $logger = null,
        private ?FeeRepository $feeRepository = null,
        private ?TaxRepository $taxRepository = null,
        private ?StatusRepository $statusRepository = null,
        private ?BalanceRepository $balanceRepository = null,
        private ?EntityManagerInterface $entityManager = null,
        private ?TransactionRepository $transactionRepository = null
    ) {}

    public function __invoke(PayinMessage $notify)
    {
        $jsonReceiver = json_decode($notify->getContent(), true);

        /**
         * @var TransactionEntity
         */
        $transaction = $this->transactionRepository->findOneBy([
            'number' => $jsonReceiver['order']['number']
        ]);

        if ($transaction->getStatus()->getId() != StatusRepository::PENDING) {
            dd('pedido já processado');
            // return;
        }

        $status = $this->statusRepository->find(StatusRepository::CANCELED);
        if ($jsonReceiver['order']['status'] == 'COMPLETE') {
            $partner = $transaction->getPartner();

            $country =  $jsonReceiver['order']['group'];

            $searchData = [
                'partner' => $partner,
                'operation' => OperationRepository::PAYIN,
                'country' => $country
            ];

            $fee = $this->feeRepository->findOneBy($searchData);
            $tax = $this->taxRepository->findOneBy($searchData);

            $amount = $jsonReceiver['order']['amount'];

            $feePercent = $fee->getValue() / 100;
            $feeAmount = $feePercent * $amount;

            $taxPercent = $tax->getValue() / 100;
            $taxAmount = $taxPercent * $amount;

            $rateAmount = $feeAmount + $taxAmount;

            $realAmount = $amount - $rateAmount;

            $balance = $this->balanceRepository->findOneBy([
                'partner' => $partner,
                'country' => $country
            ]);

            $history = new BalanceHistory();
            $history->setBalance($balance)
                ->setOperation($transaction->getOperation())
                ->setPreviusAmount($balance->getAmount())
                ->setDiscountedFee($feeAmount)
                ->setDiscountedTax($taxAmount)
                ->setDiscountedRate($rateAmount)
                ->setAmount($amount)
                ->setAmountWithDiscount($realAmount);

            $balance->setAmount($balance->getAmount() + $realAmount);
            $this->entityManager->persist($history);
            $this->entityManager->persist($balance);

            $status = $this->statusRepository->find(StatusRepository::COMPLETE);
        }
        $transaction->setStatus($status);
        $this->entityManager->persist($transaction);
        $this->entityManager->flush();

        dd($balance->getAmount(), $this->entityManager);
    }
}
