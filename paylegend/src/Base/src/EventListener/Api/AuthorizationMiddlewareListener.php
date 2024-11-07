<?php

declare(strict_types=1);

namespace App\Base\src\EventListener\Api;

use Exception;
use App\Partner\src\Entity\Partner;
use Symfony\Component\HttpFoundation\Request;
use App\Partner\src\Repository\PartnerRepository;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

#[AsEventListener(event: RequestEvent::class, method: 'onKernelRequest')]
class AuthorizationMiddlewareListener
{
    public const NAME = '_authorization';

    /**
     * Construct function
     *
     * @param PartnerRepository|null $partnerRepository
     */
    public function __construct(
        private ?PartnerRepository $partnerRepository = null
    ) {}

    public function onKernelRequest(RequestEvent $event)
    {
        /**
         * @var Request $request
         */
        $request = $event->getRequest();
        $attributes = $request->attributes;
        $partner = null;

        if ($attributes->get(self::NAME) && !$this->isAuthorized($request, $partner)) {
            throw new AccessDeniedHttpException('Você não tem permissão para acessar esta rota.');
        }

        $request->attributes->set('authorized_partner', $partner);
    }

    private function isAuthorized(Request $request, ?Partner &$partner): bool
    {
        $return = true;
        try {
            $authHeader = $request->headers->get('Authorization');
            if (null === $authHeader || !str_starts_with($authHeader, 'Basic ')) {
                $return = false;
            }

            $auth = str_replace('Basic ', '', $authHeader);
            $authDecoded = base64_decode($auth, true);
            if (false === $authDecoded) {
                $return = false;
            }

            $authDecodedArray = explode(':', $authDecoded);
            if (count($authDecodedArray) !== 2) {
                $return = false;
            }

            if (!$return) {
                return $return;
            }

            [$key, $secret] = $authDecodedArray;
            $partner = $this->partnerRepository->findOneBy([
                'key' => $key,
                'secret' => $secret
            ]);

            if (!empty($partner)) {
                $return = true;
            }
        } catch (Exception $e) {
            $return = false;
        }

        return $return;
    }
}
