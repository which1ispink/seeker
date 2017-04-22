<?php
namespace Seeker\Standard;

/**
 * Interface for the application context layer
 */
interface ContextInterface
{
    /**
     * Returns the request
     *
     * @return RequestInterface
     */
    public function getRequest();

    /**
     * Returns the response
     *
     * @return ResponseInterface
     */
    public function getResponse();

    /**
     * Returns the view
     *
     * @return ViewInterface
     */
    public function getView();

    /**
     * Sets the response status code to 404 and the view to the default 404 template
     *
     * @return void
     */
    public function show404();
}
