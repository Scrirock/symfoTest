<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class KernelRequestListener {

    public function onKernelRequest(RequestEvent $event) {
        $response = new Response();
        if ($event->getRequest()->getRealMethod() === 'POST') {
            $response->setContent("<h1>c'est bien un post</h1>");
        }
        else {
            $response->setContent("<h1>403 t'as pas le droit</h1>");
        }
        $event->setResponse($response);
    }

}