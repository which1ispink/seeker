<?php
namespace Seeker\Standard;

use Seeker\HTTP\RouteInterface;

/**
 * The application dispatcher
 */
class Dispatcher implements DispatcherInterface
{
    /**
     * Dispatches the request by calling the matching route's controller and passing it the context object
     *
     * @param RouteInterface $route
     * @param ContextInterface $context
     * @return void
     */
    public function dispatch(RouteInterface $route, ContextInterface $context)
    {
        $controller = $route->createController();
        $controller->execute($context);
    }
}
