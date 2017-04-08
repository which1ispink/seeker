<?php
namespace Seeker\Helper;

/**
 * Class responsible for parsing a url, comparing it with a route, and deciding whether they match
 */
class UrlRouteParser
{
    /**
     * @var string
     */
    private $routePath;

    /**
     * @var array
     */
    private $routeSegments = [];

    /**
     * @var string
     */
    private $requestPath;

    /**
     * @var array
     */
    private $requestSegments = [];

    /**
     * @var array
     */
    private $requestParams = [];

    /**
     * @var boolean
     */
    private $routeMatchesRequest;

    /**
     * @const string
     */
    const ROUTE_PARAM_TEMPLATE_STRING = '{param}';

    /**
     * Constructor
     *
     * @param string $routePath
     * @param string $requestPath
     */
    public function __construct($routePath, $requestPath)
    {
        $this->setRoute($routePath);
        $this->setRequest($requestPath);
        $this->compareRouteToRequest();
    }

    /**
     * Returns whether or not a route matches a request
     *
     * @return boolean
     */
    public function routeMatchesRequest()
    {
        return $this->routeMatchesRequest;
    }

    /**
     * Returns the current request's parameters
     *
     * @return array
     */
    public function getRequestParams()
    {
        return $this->requestParams;
    }

    /**
     * Extracts an array of url segments from a given url
     *
     * @param  string $url
     * @return array
     */
    public static function extractSegmentsFromUrl($url)
    {
        $url = trim($url, '/');
        return explode('/', $url);
    }

    /**
     * Sets the route properties needed to further process it
     *
     * @param string $routePath
     * @return UrlRouteParser
     */
    private function setRoute($routePath)
    {
        $routePath = strtolower(trim($routePath));
        $routePath = (substr($routePath, 0, 1) != '/') ? '/' . $routePath : $routePath;
        $routePath = (substr($routePath, -1) != '/') ? $routePath . '/' : $routePath;
        $this->routePath = $routePath;
        $this->setRouteSegments();
        return $this;
    }

    /**
     * Sets the request properties needed to further process it
     *
     * @param string $requestPath
     * @return UrlRouteParser
     */
    private function setRequest($requestPath)
    {
        $this->requestPath = $requestPath;
        $this->setRequestSegments();
        return $this;
    }

    /**
     * Sets the route segments
     *
     * @return UrlRouteParser
     */
    private function setRouteSegments()
    {
        $this->routeSegments = self::extractSegmentsFromUrl($this->routePath);
        return $this;
    }

    /**
     * Sets the request path segments
     *
     * @return UrlRouteParser
     */
    private function setRequestSegments()
    {
        $this->requestSegments = self::extractSegmentsFromUrl($this->requestPath);
        return $this;
    }

    /**
     * Compares the current route and request and decides whether or not they match
     *
     * @return UrlRouteParser
     */
    private function compareRouteToRequest()
    {
        $routeMatchesRequest = true;

        if (count($this->routeSegments) != count($this->requestSegments)) {
            $routeMatchesRequest = false;
        }

        if ($routeMatchesRequest) {
            foreach ($this->routeSegments as $key => $routeSegment) {
                if ($routeSegment == self::ROUTE_PARAM_TEMPLATE_STRING) {
                    $this->requestParams[] = $this->requestSegments[$key];
                } else {
                    if ($routeSegment != $this->requestSegments[$key]) {
                        $routeMatchesRequest = false;
                        break;
                    }
                }
            }
        }

        $this->routeMatchesRequest = $routeMatchesRequest;
        return $this;
    }
}
