<?php

declare(strict_types=1);

namespace App\Partner\src\Repository;

use App\Partner\src\Entity\PartnerUser;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Role>
 */
class PartnerUserRepository extends ServiceEntityRepository
{
    /**
     * Construct function
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartnerUser::class);
    }
}
