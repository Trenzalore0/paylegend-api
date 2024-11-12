<?php

declare(strict_types=1);

namespace App\Transaction\src\Controller\Api;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Transaction\src\Entity\TransactionEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Base\src\EventListener\Api\AuthorizationMiddlewareListener;
use App\Transaction\src\Repository\{StatusRepository, OperationRepository, TransactionRepository};

class PayinController extends AbstractController
{
    public function __construct(
        private ?EntityManagerInterface $entityManager = null
    ) {}

    #[Route(
        path: '/payin',
        name: 'payin',
        methods: [Request::METHOD_POST],
        defaults: [AuthorizationMiddlewareListener::NAME => true]
    )]
    public function execute(Request $request)
    {
        $jsonContent = json_decode($request->getContent(), true);
        /**
         * @var TransactionRepository
         */
        $transactionRepository = $this->entityManager->getRepository(TransactionEntity::class);

        $checkNumber = $transactionRepository->findBy([
            'number' => $jsonContent['order']['number']
        ]);

        if (!empty($checkNumber)) {
            return $this->json(['error' => 'order number is used']);
        }

        $partner = $request->attributes->get('authorized_partner');

        $transactionData = $transactionRepository->getTransactionDataArray(
            e2eId: 'E2E_' . uniqid(),
            operation: OperationRepository::PAYIN,
            status: StatusRepository::PENDING,
            partner: $partner,
            userUid: $jsonContent['user']['uid'],
            userDocument: $jsonContent['user']['document'],
            orderNumber: $jsonContent['order']['number'],
            orderAmount: $jsonContent['order']['amount'],
            orderGroup: $jsonContent['order']['group']
        );
        $transaction = $transactionRepository->createTransaction($transactionData);
        $t = $transactionRepository->getTransactionById($transaction->getId());

        $data = $transactionRepository->createReponseDataArray($t, true);
        return $this->json($data);
    }
}
