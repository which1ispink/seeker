<?php
namespace Seeker\Standard;

use Seeker\HTTP\RouteInterface;
use Seeker\HTTP\RequestInterface;
use Seeker\HTTP\ResponseInterface;

/**
 * The application router
 */
class Router implements RouterInterface
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * Adds a route to the available application routes
     *
     * @param RouteInterface $route
     * @return Router
     */
    public function addRoute(RouteInterface $route)
    {
        $this->routes[] = $route;
        return $this;
    }

    /**
     * Adds multiple routes to the available application routes
     *
     * @param array $routes
     * @return Router
     */
    public function addRoutes(array $routes)
    {
        foreach ($routes as $route) {
            $this->addRoute($route);
        }
        return $this;
    }

    /**
     * Returns the available application routes
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Returns a matching route given a request, or null if none found
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return null|RouteInterface
     */
    public function route(RequestInterface $request, ResponseInterface $response)
    {
        $matchingRoute = null;

        foreach ($this->routes as $route) {
            if ($route->matchesRequest($request)) {
                $matchingRoute = $route;
                break;
            }
        }

        if (! $matchingRoute) {
            $response->raiseRoutingError();
        }

        return $matchingRoute;
    }
}
