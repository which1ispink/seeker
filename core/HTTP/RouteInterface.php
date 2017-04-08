<?php
namespace Seeker\HTTP;

/**
 * Interface for an application route
 */
interface RouteInterface
{
    /**
     * Returns whether or not a route matches a request
     *
     * @param RequestInterface $request
     * @return boolean
     */
    public function matches(RequestInterface $request);

    /**
     * Returns an instance of the route's action controller
     *
     * @return ActionControllerInterface
     */
    public function createController();
}
