<?php

declare(strict_types=1);

namespace App\Transaction\src\Repository;

use App\Transaction\src\Entity\Operation;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Operation>
 */
class OperationRepository extends ServiceEntityRepository
{
    public const PAYIN = 1;
    public const PAYOUT = 2;
    public const REFUND = 3;

    /**
     * Construct function
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Operation::class);
    }
}
