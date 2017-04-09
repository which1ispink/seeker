<?php
namespace Seeker\Standard;

use Seeker\HTTP\RouteInterface;

/**
 * Interface for the application dispatcher
 */
interface DispatcherInterface
{
    /**
     * Dispatches the request by calling the matching route's controller and passing it the context object
     *
     * @param RouteInterface $route
     * @param ContextInterface $context
     * @return void
     */
    public function dispatch(RouteInterface $route, ContextInterface $context);
    
    /**
     * Returns an instance of the route's action controller class
     *
     * @param RouteInterface $route
     * @param ContextInterface $context
     * @return ActionControllerInterface
     */
    public static function createControllerInstance(RouteInterface $route, ContextInterface $context);
}
