<?php

declare(strict_types=1);

namespace Innomedio\Sulu\FormLandingPageBundle\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class CustomFormRedirectEventListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();

        if (!$request->query->get('send')) {
            return;
        }

        $redirectUrl = $this->sanitize($request, FormRedirectTargetRequestListener::FIELD_NAME, 'path');
        $querystring = $this->sanitize($request, FormRedirectQuerystringRequestListener::FIELD_NAME, 'query');

        if (!empty($querystring)) {
            $redirectUrl .= '?'.$querystring;
        }

        if (!empty($redirectUrl)) {
            $event->setResponse(new RedirectResponse($redirectUrl));
        }
    }

    private function sanitize(Request $request, string $sessionName, string $urlValue): string
    {
        $result = strip_tags(parse_url($request->getSession()->get($sessionName) ?? '')[$urlValue] ?? '');

        $request->getSession()->remove($sessionName);

        return $result;
    }
}
