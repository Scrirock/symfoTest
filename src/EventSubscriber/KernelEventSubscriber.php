<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class KernelEventSubscriber implements EventSubscriberInterface {

    /**
     * @return \array[][]
     */
    public static function getSubscribedEvents(): array {
        return [
            KernelEvents::EXCEPTION => [
                ['displayKernelExceptionTriggered', 255],
                ['logKernelExceptionTriggered', 0],
            ],
            KernelEvents::REQUEST => [
                ['displayKernelRequestTriggered', 255],
            ]
        ];
    }

    /**
     * Display an error message if the request type is different from POST
     * @param RequestEvent $event
     */
    public function displayKernelRequestTriggered(RequestEvent $event) {
        $response = new Response();

        if ($event->getRequest()->getRealMethod() === 'POST') {
            $response->setContent("<h1>c'est bien un post</h1>");
        }
        else {
            $response->setContent("<h1>Type de requête non autorisée par le kernel</h1>");
        }
        $event->setResponse($response);

    }

    /**
     * Display an error message on the web page if tue route doesn't exist
     * @param ExceptionEvent $event
     */
    public function displayKernelExceptionTriggered(ExceptionEvent $event) {
        $response = new Response();
        $response->setContent("<h1>Une erreur est survenue</h1>");
        $event->setResponse($response);
    }

    /**
     * Log function in case of error
     * @param ExceptionEvent $event
     */
    public function logKernelExceptionTriggered(ExceptionEvent $event) {
        $message = $event->getThrowable()->getMessage();
        file_put_contents(__DIR__ . '../../var/log/dev.log', $message, FILE_APPEND);
    }
}