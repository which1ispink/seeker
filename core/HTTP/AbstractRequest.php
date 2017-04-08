<?php
namespace Seeker\HTTP;

/**
 * Abstract base class for a request
 */
abstract class AbstractRequest implements RequestInterface
{
    /**
     * @var array
     */
    protected $params;

    /**
     * Constructor
     *
     * @param array $params (optional)
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * Returns one of the current request parameters by key
     *
     * @param string $key
     * @return mixed
     */
    public function getParam($key)
    {
        if (! isset($this->params[$key])) {
            throw new \InvalidArgumentException(
                "The request parameter with key '$key' is invalid."
            );
        }
        return $this->params[$key];
    }

    /**
     * Returns all current request parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}
