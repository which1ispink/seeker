<?php
namespace Seeker\Standard;

use Seeker\HTTP\RouteInterface;
use Seeker\HTTP\RequestInterface;
use Seeker\HTTP\ResponseInterface;

/**
 * Interface for the application router
 */
interface RouterInterface
{
    /**
     * Adds a route to the available application routes
     *
     * @param RouteInterface $route
     * @return RouterInterface
     */
    public function addRoute(RouteInterface $route);

    /**
     * Adds multiple routes to the available application routes
     *
     * @param array $routes
     * @return RouterInterface
     */
    public function addRoutes(array $routes);

    /**
     * Returns the available application routes
     *
     * @return array
     */
    public function getRoutes();

    /**
     * Returns a matching route given a request, or null if none found
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return null|RouteInterface
     */
    public function route(RequestInterface $request, ResponseInterface $response);
}
