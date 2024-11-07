<?php

declare(strict_types=1);

namespace App\Transaction\src\Repository;

use Doctrine\Persistence\ManagerRegistry;
use App\Transaction\src\Entity\TransactionAttribute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<TransactionAttribute>
 */
class TransactionAttributeRepository extends ServiceEntityRepository
{
    /**
     * Construct function
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TransactionAttribute::class);
    }
}
