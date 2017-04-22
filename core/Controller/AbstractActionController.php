<?php
namespace Seeker\Controller;

use Seeker\Standard\ContextInterface;

/**
 * Abstract base class for action controllers
 */
abstract class AbstractActionController
{
    /**
     * @var ContextInterface
     */
    private $context;

    /**
     * @var RequestInterface $request
     */
    private $request;

    /**
     * @var ResponseInterface $response
     */
    private $response;

    /**
     * @var ViewInterface $view
     */
    private $view;

    /**
     * @var array $params
     */
    private $params;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param array $params (optional)
     */
    public function __construct(ContextInterface $context, array $params = [])
    {
        $this->context = $context;
        $this->request = $context->getRequest();
        $this->response = $context->getResponse();
        $this->view = $context->getView();
        $this->params = $params;
    }

    /**
     * Returns the request
     *
     * @return RequestInterface
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * Returns the response
     *
     * @return ResponseInterface
     */
    protected function getResponse()
    {
        return $this->response;
    }

    /**
     * Returns the view
     *
     * @return ViewInterface
     */
    protected function getView()
    {
        return $this->view;
    }

    /**
     * Returns the route parameters
     *
     * @return array
     */
    protected function getParams()
    {
        return $this->params;
    }

    /**
     * Sends back a 404 response and template to the client immediately when called
     *
     * @return void
     */
    protected function show404()
    {
        $this->context->show404();
        $this->response->send($this->view);
    }
}
