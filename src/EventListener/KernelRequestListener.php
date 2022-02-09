<?php
//
//namespace App\EventListener;
//
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpKernel\Event\RequestEvent;
//
//class KernelRequestListener {
//
//    /**
//     * Display an error message if the request type is different from POST
//     * @param RequestEvent $event
//     */
//    public function onKernelRequest(RequestEvent $event) {
//        $response = new Response();
//        if ($event->getRequest()->getRealMethod() === 'POST') {
//            $response->setContent("<h1>c'est bien un post</h1>");
//        }
//        else {
//            $response->setContent("<h1>403 t'as pas le droit</h1>");
//        }
//        $event->setResponse($response);
//    }
//
//}