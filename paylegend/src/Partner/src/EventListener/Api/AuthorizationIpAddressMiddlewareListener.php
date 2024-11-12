<?php

declare(strict_types=1);

namespace App\Partner\src\EventListener\Api;

use Symfony\Component\HttpFoundation\Request;
use App\Partner\src\Repository\WhiteListRepository;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

#[AsEventListener(event: RequestEvent::class, method: 'onKernelRequest')]
class AuthorizationIpAddressMiddlewareListener
{

    public const NAME = '_authorizationIpAddress';

    public function __construct(
        private ?WhiteListRepository $whiteListRepository = null
    ) {}

    public function onKernelRequest(RequestEvent $event)
    {
        /**
         * @var Request $request
         */
        $request = $event->getRequest();

        if ($request->attributes->get(self::NAME) && !$this->isAuthorized($request->getClientIp())) {
            throw new AccessDeniedHttpException('Você não tem permissão para acessar esta rota.');
        }
    }

    private function isAuthorized(string $ipAddress)
    {
        $check = $this->whiteListRepository->findOneBy([
            'ipAddress' => $ipAddress
        ]);

        if (empty($check)) {
            return false;
        }

        return true;
    }
}
