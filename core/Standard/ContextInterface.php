<?php
namespace Seeker\Standard;

use Seeker\HTTP\RequestInterface;
use Seeker\HTTP\ResponseInterface;
use Seeker\View\ViewInterface;

/**
 * Interface for the application context layer
 */
interface ContextInterface
{
    /**
     * Sets the request
     *
     * @param RequestInterface $request
     * @return ContextInterface
     */
    public function setRequest(RequestInterface $request);

    /**
     * Returns the request
     *
     * @return RequestInterface
     */
    public function getRequest();

    /**
     * Sets the response
     *
     * @param ResponseInterface $response
     * @return ContextInterface
     */
    public function setResponse(ResponseInterface $response);

    /**
     * Returns the response
     *
     * @return ResponseInterface
     */
    public function getResponse();

    /**
     * Sets the view
     *
     * @param ViewInterface $view
     * @return ContextInterface
     */
    public function setView(ViewInterface $view);

    /**
     * Returns the view
     *
     * @return ViewInterface
     */
    public function getView();
}
