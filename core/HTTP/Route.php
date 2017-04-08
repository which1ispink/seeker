<?php
namespace Seeker\HTTP;

use Seeker\Standard\ConfigurationReader;
use Seeker\Helper\UrlRouteParser;

/**
 * An application route
 */
class Route implements RouteInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $controllerClass;

    /**
     * @var array
     */
    private $controllerParams = [];

    /**
     * Constructor
     *
     * @param string $path
     * @param string $controllerClass
     */
    public function __construct($path, $controllerClass)
    {
        $this->path = $path;
        $this->controllerClass = $controllerClass;
    }

    /**
     * Returns whether or not a route matches a request
     *
     * @param RequestInterface $request
     * @return boolean
     */
    public function matches(RequestInterface $request)
    {
        if (! $request instanceof Request) {
            return false;
        }

        $urlRouteParser = new UrlRouteParser($this->path, $request->getPath());
        if ($urlRouteParser->routeMatchesRequest()) {
            $this->controllerParams = $urlRouteParser->getRequestParams();
            return true;
        }
        return false;
    }

    /**
     * Returns an instance of the route's action controller
     *
     * @return ActionControllerInterface
     */
    public function createController()
    {
        $controller = ConfigurationReader::get('action_controllers_namespace') . $this->controllerClass;
        if (! class_exists($controller)) {
            throw new \Exception(
                "The action controller class '$controller' could not be found."
            );
        }
        return new $controller($this->controllerParams);
    }
}
