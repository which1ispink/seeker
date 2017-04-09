<?php
namespace Seeker\HTTP;

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
     * @var string
     */
    private $controllerAction;

    /**
     * @var array
     */
    private $parameterValues = [];

    /**
     * Constructor
     *
     * @param string $path
     * @param string $controllerClass
     * @param string $controllerAction
     */
    public function __construct($path, $controllerClass, $controllerAction)
    {
        $this->path = $path;
        $this->controllerClass = $controllerClass;
        $this->controllerAction = $controllerAction;
    }

    /**
     * Returns whether or not a route matches a request
     *
     * @param RequestInterface $request
     * @return boolean
     */
    public function matchesRequest(RequestInterface $request)
    {
        if (! $request instanceof Request) {
            return false;
        }

        $urlRouteParser = new UrlRouteParser($this->path, $request->getPath());
        if ($urlRouteParser->routeMatchesRequest()) {
            $this->parameterValues = $urlRouteParser->getRequestParams();
            return true;
        }
        return false;
    }

    /**
     * Returns the route's controller class
     *
     * @return string
     */
    public function getControllerClass()
    {
        return $this->controllerClass;
    }
    
    /**
     * Returns the route's controller action
     *
     * @return string
     */
    public function getControllerAction()
    {
        return $this->controllerAction;
    }
    
    /**
     * Returns the route's parameter values
     *
     * @return array
     */
    public function getParameterValues()
    {
        return $this->parameterValues;
    }
}
