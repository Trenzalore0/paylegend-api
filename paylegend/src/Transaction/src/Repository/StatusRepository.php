<?php

declare(strict_types=1);

namespace App\Transaction\src\Repository;

use App\Transaction\src\Entity\Status;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Status>
 */
class StatusRepository extends ServiceEntityRepository
{
    public const PENDING = 1;
    public const CANCELED = 2;
    public const COMPLETE = 3;

    /**
     * Construct function
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Status::class);
    }
}
