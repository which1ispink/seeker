<?php
namespace Seeker\HTTP;

/**
 * Interface for a request
 */
interface RequestInterface
{
    /**
     * Returns one of the current request parameters by key
     *
     * @param string $key
     * @return mixed
     */
    public function getParam($key);

    /**
     * Returns all current request parameters
     *
     * @return array
     */
    public function getParams();
}
