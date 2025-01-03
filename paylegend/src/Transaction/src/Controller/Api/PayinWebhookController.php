<?php

declare(strict_types=1);

namespace App\Transaction\src\Controller\Api;

use App\Transaction\src\Queue\PayinMessage;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\{Envelope, MessageBusInterface};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Partner\src\EventListener\Api\AuthorizationIpAddressMiddlewareListener;

class PayinWebhookController extends AbstractController
{

    public function __construct(
        private ?MessageBusInterface $bus = null
    ) {}

    #[Route(
        path: '/payin-webhook',
        name: 'payin-webhook',
        methods: [Request::METHOD_POST],
        defaults: [
            AuthorizationIpAddressMiddlewareListener::NAME => true
        ]
    )]
    public function execute(Request $request)
    {
        $amqpStamp = new AmqpStamp('webhook_payin');
        $envelope = new Envelope(new PayinMessage($request->getContent()), [$amqpStamp]);
        $this->bus->dispatch($envelope);
        return new Response('OK');
    }
}
