<?php
namespace Seeker\Standard;

use Seeker\HTTP\RequestInterface;
use Seeker\HTTP\ResponseInterface;
use Seeker\View\ViewInterface;

/**
 * Context layer, giving access to many important application objects from one place
 */
class Context implements ContextInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var ViewInterface
     */
    private $view;

    /**
     * Constructor
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param ViewInterface $view
     */
    public function __construct(RequestInterface $request, ResponseInterface $response, ViewInterface $view)
    {
        $this->setRequest($request);
        $this->setResponse($response);
        $this->setView($view);
    }

    /**
     * Sets the request
     *
     * @param RequestInterface $request
     * @return Context
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Returns the request
     *
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Sets the response
     *
     * @param ResponseInterface $response
     * @return Context
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * Returns the response
     *
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets the view
     *
     * @param ViewInterface $view
     * @return Context
     */
    public function setView(ViewInterface $view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * Returns the view
     *
     * @return ViewInterface
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Sends back a 404 response and a fitting template to the client
     *
     * @return void
     */
    public function show404()
    {
        $this->response->raiseRoutingError();
        $this->view->setTemplate('404');
    }
}
