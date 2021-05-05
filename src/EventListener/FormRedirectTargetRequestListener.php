<?php

declare(strict_types=1);

namespace Innomedio\Sulu\FormLandingPageBundle\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class FormRedirectTargetRequestListener extends AbstractSuluRedirectFieldHandler
{
    public const FIELD_NAME = '_sulu_form_redirect';

    public function onKernelRequest(RequestEvent $event)
    {
        $this->saveToSession($event, self::FIELD_NAME);
    }
}
