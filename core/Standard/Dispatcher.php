<?php
namespace Seeker\Standard;

use Seeker\HTTP\RouteInterface;
use Seeker\Standard\ConfigurationReader;
use Seeker\Controller\AbstractActionController;

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
        $controller = self::createControllerInstance($route, $context);
        self::callControllerAction($controller, $route);
    }

    /**
     * Returns an instance of the route's action controller class
     *
     * @param RouteInterface $route
     * @param ContextInterface $context
     * @return AbstractActionController
     */
    public static function createControllerInstance(RouteInterface $route, ContextInterface $context)
    {
        $controller = ConfigurationReader::get('action_controllers_namespace') . $route->getControllerClass();
        if (! class_exists($controller)) {
            throw new \Exception(
                "The action controller class '$controller' could not be found."
            );
        }
        return new $controller($context, $route->getParameterValues());
    }

    /**
     * Calls a route's controller action
     *
     * @param AbstractActionController $controller
     * @param RouteInterface $route
     * @return void
     */
    public static function callControllerAction(AbstractActionController $controller, RouteInterface $route)
    {
        $action = $route->getControllerAction();
        if (! method_exists($controller, $action)) {
            throw new \Exception(
                "The controller action '$action' could not be found."
            );
        }
        $controller->{$action}();
    }
}
