<?php

declare(strict_types=1);

namespace App\Transaction\src\Repository;

use App\Partner\src\Entity\Partner;
use Doctrine\Persistence\ManagerRegistry;
use App\Transaction\src\Entity\{Status, Operation};
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Transaction\src\Entity\{TransactionEntity, TransactionValueInt, TransactionAttribute, TransactionValueText, TransactionValueDouble, TransactionValueString};

/**
 * @extends ServiceEntityRepository<TransactionEntity>
 */
class TransactionRepository extends ServiceEntityRepository
{
    /**
     * Construct function
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TransactionEntity::class);
    }

    public function getTransactionById(?int $transactionId): array
    {
        $entityManager = $this->getEntityManager();

        $attributes = $entityManager->createQuery(
            'SELECT att.id, att.name, att.type
            FROM App\Transaction\src\Entity\TransactionAttribute att'
        )->getResult();

        $select = '';
        $from = [];
        foreach ($attributes as $att) {
            $select .= " max(case when transaction_atts.transaction_attribute_id = {$att['id']} then transaction_atts.value end) as '{$att['name']}', ";
            $tmp = " SELECT * FROM transaction_value_{$att['type']} ";
            if (!in_array($tmp, $from)) {
                $from[] = $tmp;
            }
        }

        $from = implode('UNION', $from);
        $query = "SELECT {$select} te.*
            FROM transaction_entity te
            LEFT JOIN ({$from}) as transaction_atts ON te.id = transaction_atts.transaction_entity_id
            WHERE te.id = :tid GROUP BY te.id";

        $connection = $entityManager->getConnection();
        $stmt = $connection->executeQuery($query, ['tid' => $transactionId]);
        return $stmt->fetchAllAssociative()[0];
    }

    public function createTransaction(array $data): TransactionEntity
    {
        $entityManager = $this->getEntityManager();

        $operation = $entityManager->getRepository(Operation::class)->find($data['operation']);
        $pending = $entityManager->getRepository(Status::class)->find($data['status']);

        $transaction = new TransactionEntity();
        $transaction->setTxId($data['tx_id']);
        $transaction->setE2eId($data['e2e_id']);

        $transaction->setNumber($data['number']);
        $transaction->setOperation($operation);
        $transaction->setStatus($pending);
        $transaction->setPartner($data['partner']);

        foreach ($data['attributes'] as $attrData) {
            $attribute = $entityManager->getRepository(TransactionAttribute::class)
                ->findOneBy(['name' => $attrData['name']]);

            switch ($attribute->getType()) {
                case 'int':
                    $value = new TransactionValueInt();
                    $value->setValue((int)$attrData['value']);
                    break;
                case 'double':
                    $value = new TransactionValueDouble();
                    $value->setValue((float)$attrData['value']);
                    break;
                case 'string':
                    $value = new TransactionValueString();
                    $value->setValue((string)$attrData['value']);
                    break;
                case 'text':
                    $value = new TransactionValueText();
                    $value->setValue((string)$attrData['value']);
                    break;
                default:
            }

            $value->setTransactionEntity($transaction);
            $value->setTransactionAttribute($attribute);
            $entityManager->persist($value);
        }

        $entityManager->persist($transaction);
        $entityManager->flush();

        return $transaction;
    }

    public function getTransactionDataArray(
        string $e2eId,
        int $operation,
        int $status,
        Partner $partner,
        int $userUid,
        string $userDocument,
        string $orderNumber,
        float $orderAmount,
        int $orderGroup
    ) {
        return [
            'tx_id' => $orderNumber,
            'e2e_id' => $e2eId,
            'operation' => $operation,
            'status' => $status,
            'partner' => $partner,
            'number' => $orderNumber,
            'attributes' => [
                [
                    'name' => 'user_uid',
                    'type' => 'string',
                    'value' => $userUid
                ],
                [
                    'name' => 'user_document',
                    'type' => 'string',
                    'value' => $userDocument
                ],
                [
                    'name' => 'amount',
                    'type' => 'double',
                    'value' => $orderAmount
                ],
                [
                    'name' => 'group',
                    'type' => 'int',
                    'value' => $orderGroup
                ],
            ]
        ];
    }

    public function createReponseDataArray(array $t, bool $hasPix = false) {
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
            ]
        ];

        if ($hasPix) {
            $data['pix'] = [
                'pix_copiacola' => '{ copia e cola full string }',
                'pix_qrcode_url' => '{ qrcode\'s url }',
                'pix_message' => 'Faça seu PIX utilizando o QRCODE (aponte a câmera do seu celular), ou utilize o código copia e cola.'
            ];
        }

        return $data;
    }
}
