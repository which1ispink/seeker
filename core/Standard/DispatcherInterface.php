<?php
namespace Seeker\Standard;

use Seeker\HTTP\RouteInterface;
use Seeker\Controller\AbstractActionController;

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
     * @return AbstractActionController
     */
    public static function createControllerInstance(RouteInterface $route, ContextInterface $context);

    /**
     * Calls a route's controller action
     *
     * @param AbstractActionController $controller
     * @param RouteInterface $route
     * @return void
     */
    public static function callControllerAction(AbstractActionController $controller, RouteInterface $route);
}
