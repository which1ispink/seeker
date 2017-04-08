<?php
namespace Seeker\HTTP;

use Seeker\View\ViewInterface;

/**
 * Interface for an HTTP response
 */
interface ResponseInterface
{
    /**
     * Raises a routing error
     *
     * @return ResponseInterface
     */
    public function raiseRoutingError();

    /**
     * Raises a processing error
     *
     * @return ResponseInterface
     */
    public function raiseProcessingError();

    /**
     * Returns whether or not the current response is erroneous
     *
     * @return boolean
     */
    public function isError();

    /**
     * Adds a header to the current response
     *
     * @param string $header
     * @return ResponseInterface
     */
    public function addHeader($header);

    /**
     * Adds an array of headers to the current response
     *
     * @param array $headers
     * @return ResponseInterface
     */
    public function addHeaders(array $headers);

    /**
     * Returns the headers of the current response
     *
     * @return array
     */
    public function getHeaders();

    /**
     * Sends the response to the client
     *
     * @param ViewInterface $view
     * @return void
     */
    public function send(ViewInterface $view);
}
