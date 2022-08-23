<?php

declare(strict_types=1);

namespace Innomedio\Sulu\FormLandingPageBundle\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

abstract class AbstractSuluRedirectFieldHandler
{
    protected function saveToSession(RequestEvent $event, string $field)
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();

        if (!$request->isMethod('post')) {
            return;
        }

        if (!$redirectUrl = $request->request->get($field)) {
            return;
        }

        $request->getSession()->set($field, $redirectUrl);
    }
}
