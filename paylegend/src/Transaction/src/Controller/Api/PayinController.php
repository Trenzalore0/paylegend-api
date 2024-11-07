<?php

declare(strict_types=1);

namespace App\Transaction\src\Controller\Api;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Transaction\src\Entity\TransactionEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Base\src\EventListener\Api\AuthorizationMiddlewareListener;
use App\Transaction\src\Repository\{StatusRepository, OperationRepository};

class PayinController extends AbstractController
{
    public function __construct(
        private ?EntityManagerInterface $entityManager = null
    ) {}

    #[Route('/payin', name: 'payin', methods: [Request::METHOD_POST], defaults: [AuthorizationMiddlewareListener::NAME => true])]
    public function execute(Request $request)
    {
        $jsonContent = json_decode($request->getContent(), true);
        $transactionRepository = $this->entityManager->getRepository(TransactionEntity::class);

        $checkNumber = $transactionRepository->findBy([
            'number' => $jsonContent['order']['number']
        ]);

        if (!empty($checkNumber)) {
            return $this->json(['error' => 'order number is used', 't' => $checkNumber]);
        }

        $partner = $request->attributes->get('authorized_partner');

        $transactionData = [
            'tx_id' => $jsonContent['order']['number'],
            'e2e_id' => 'E2E_' . uniqid(),
            'operation' => OperationRepository::PAYIN,
            'status' => StatusRepository::PENDING,
            'partner' => $partner,
            'number' => $jsonContent['order']['number'],
            'attributes' => [
                [
                    'name' => 'user_uid',
                    'type' => 'string',
                    'value' => $jsonContent['user']['uid']
                ],
                [
                    'name' => 'user_document',
                    'type' => 'string',
                    'value' => $jsonContent['user']['document']
                ],
                [
                    'name' => 'amount',
                    'type' => 'double',
                    'value' => $jsonContent['order']['amount']
                ],
                [
                    'name' => 'group',
                    'type' => 'int',
                    'value' => $jsonContent['order']['group']
                ],
            ]
        ];
        $transaction = $transactionRepository->createTransaction($transactionData);
        $t = $transactionRepository->getTransactionById($transaction->getId());

        $data = [
            'transaction' => [
                'user' => [
                    'uid' => $t['user_uid'],
                    'document' => $t['user_document'],
                ],
                'order' => [
                    'number' => $t['number'],
                    'amount' => $t['amount'],
                    'group' => $t['group'],
                    'operation' => $t['operation_id'],
                    'status' => $t['status_id'],
                    'created_at' => $t['created_at'],
                    'updated_at' => $t['updated_at'],
                ],
                'pix' => [
                    'pix_copiacola' => '{ copia e cola full string }',
                    'pix_qrcode_url' => '{ qrcode\'s url }',
                    'pix_message' => 'Faça seu PIX utilizando o QRCODE (aponte a câmera do seu celular), ou utilize o código copia e cola.'
                ]
            ]
        ];
        return $this->json($data);
    }
}
