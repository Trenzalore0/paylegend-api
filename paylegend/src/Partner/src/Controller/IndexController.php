<?php

declare(strict_types=1);

namespace App\Partner\src\Controller;

use App\Partner\src\Entity\Role;
use App\Partner\src\Entity\Partner;
use App\Transaction\src\Entity\Status;
use App\Partner\src\Entity\PartnerUser;
use Doctrine\ORM\EntityManagerInterface;
use App\Transaction\src\Entity\Operation;
use App\Transaction\src\Entity\TransactionAttribute;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\{Response, JsonResponse};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function __construct(
        private ?EntityManagerInterface $entityManager = null
    ) {}

    #[Route('/json', name: 'app_test_json')]
    public function index(): JsonResponse
    {
        // $role = new Role();
        // $role->setName('admin');

        // $partner = new Partner();
        // $partner->setName('Paylegend');
        // $partner->setKey(bin2hex(random_bytes(10)));
        // $partner->setSecret(bin2hex(random_bytes(20)));
        // $partner->setWdpass(bin2hex(random_bytes(20)));

        // $partnerUser = new PartnerUser();
        // $partnerUser->setName('kley');
        // $partnerUser->setEmail('kleydson@gmail.com');
        // $partnerUser->setPassword(bin2hex(random_bytes(20)));
        // $partnerUser->setRole($role);
        // $partnerUser->setPartner($partner);

        // $this->entityManager->persist($role);
        // $this->entityManager->persist($partner);
        // $this->entityManager->persist($partnerUser);

        // $this->entityManager->flush();

        $data = [
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ];
        return $this->json($data);
    }

    #[Route('/template', name: 'app_test_template')]
    public function testTemplate(): Response
    {
        // $payin = new Operation();
        // $payin->setName('Payin');

        // $payout = new Operation();
        // $payout->setName('Payout');

        // $this->entityManager->persist($payin);
        // $this->entityManager->persist($payout);

        // $pending = new Status();
        // $pending->setName('Pending');

        // $canceled = new Status();
        // $canceled->setName('Canceled');

        // $complete = new Status();
        // $complete->setName('Complete');

        // $this->entityManager->persist($pending);
        // $this->entityManager->persist($canceled);
        // $this->entityManager->persist($complete);

        // $att_amount = new TransactionAttribute();
        // $att_amount->setName('amount')->setType('double');
        
        // $att_user_document = new TransactionAttribute();
        // $att_user_document->setName('user_document')->setType('string');

        // $att_user_uid = new TransactionAttribute();
        // $att_user_uid->setName('user_uid')->setType('string');

        // $att_order_group = new TransactionAttribute();
        // $att_order_group->setName('group')->setType('int');

        // $this->entityManager->persist($att_amount);
        // $this->entityManager->persist($att_user_document);
        // $this->entityManager->persist($att_user_uid);
        // $this->entityManager->persist($att_order_group);

        $this->entityManager->flush();

        return $this->render('@Partner/test.html.twig', [
            'user_first_name' => 'kleydson',
            'user_age' => 25
        ]);
    }
}
