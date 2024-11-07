<?php

declare(strict_types=1);

namespace App\Balance\src\Repository;

use App\Balance\src\Entity\Balance;
use App\Partner\src\Entity\Partner;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Balance>
 */
class BalanceRepository extends ServiceEntityRepository
{
    /**
     * Construct function
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Balance::class);
    }

    public function payinAction(Partner $partner, int $countryId)
    {
        $entityManager = $this->getEntityManager();
        


        
    }

    public function payoutAction() {}
}
