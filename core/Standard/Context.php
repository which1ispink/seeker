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
    private function setRequest(RequestInterface $request)
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
    private function setResponse(ResponseInterface $response)
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
    private function setView(ViewInterface $view)
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
     * Sets the response status code to 404 and the view to the default 404 template
     *
     * @return void
     */
    public function show404()
    {
        $this->response->raiseRoutingError();
        $this->view->setTemplate('404');
    }
}
