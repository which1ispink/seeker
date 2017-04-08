<?php
namespace Seeker\HTTP;

use Seeker\View\ViewInterface;

/**
 * The HTTP response
 */
class Response implements ResponseInterface
{
    /**
     * @const string
     */
    const VERSION_1_1 = 'HTTP/1.1';

    /**
     * @var string
     */
    private $version;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var boolean
     */
    private $error = false;

    /**
     * Constructor
     *
     * @param string $version (optional)
     */
    public function __construct($version = self::VERSION_1_1)
    {
        // Override the default or passed in HTTP version with SERVER_PROTOCOL to avoid bugs on certain platforms
        $this->version = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : $version;
    }

    /**
     * Raises a routing error
     *
     * @return Response
     */
    public function raiseRoutingError()
    {
        $this->headers[] = "{$this->version} 404 Not Found";
        $this->error = true;
        return $this;
    }

    /**
     * Raises a processing error
     *
     * @return Response
     */
    public function raiseProcessingError()
    {
        $this->headers[] = "{$this->version} 503 Service Unavailable";
        $this->error = true;
        return $this;
    }

    /**
     * Returns whether or not the current response is erroneous
     *
     * @return boolean
     */
    public function isError()
    {
        return $this->error;
    }

    /**
     * Adds a header to the current response
     *
     * @param string $header
     * @return Response
     */
    public function addHeader($header)
    {
        $this->headers[] = $header;
        return $this;
    }

    /**
     * Adds an array of headers to the current response
     *
     * @param array $headers
     * @return Response
     */
    public function addHeaders(array $headers)
    {
        foreach ($headers as $header) {
            $this->addHeader($header);
        }
        return $this;
    }

    /**
     * Returns the headers of the current response
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Sends the response to the client
     *
     * @param ViewInterface $view
     * @return void
     */
    public function send(ViewInterface $view)
    {
        if (! headers_sent()) {
            array_walk($this->headers, function ($header) {
                header($header, true);
            });
            echo $view->render();
        }
    }
}
