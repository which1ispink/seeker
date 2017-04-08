<?php
namespace Seeker\Standard;

/**
 * The application's front controller
 */
class FrontController
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var DispatcherInterface
     */
    private $dispatcher;

    /**
     * Constructor
     *
     * @param RouterInterface $router
     * @param DispatcherInterface $dispatcher
     */
    public function __construct(RouterInterface $router, DispatcherInterface $dispatcher)
    {
        $this->router = $router;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Runs the front controller and sends back the response to the client
     *
     * @param ContextInterface $context
     * @return void
     */
    public function run(ContextInterface $context)
    {
        $route = $this->router->route($context->getRequest(), $context->getResponse());
        if (! is_null($route)) {
            $this->dispatcher->dispatch($route, $context);
        } else {
            $context->show404();
        }
        $context->getResponse()->send($context->getView());
    }
}
