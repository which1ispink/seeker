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
    public function matchesRequest(RequestInterface $request);

    /**
     * Returns the route's controller class
     *
     * @return string
     */
    public function getControllerClass();
    
    /**
     * Returns the route's controller action
     *
     * @return string
     */
    public function getControllerAction();
    
    /**
     * Returns the route's parameter values
     *
     * @return array
     */
    public function getParameterValues();
}
