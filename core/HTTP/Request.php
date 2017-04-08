<?php
namespace Seeker\HTTP;

use Seeker\Standard\ConfigurationReader;

/**
 * The HTTP request
 */
class Request extends AbstractRequest
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $scheme;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $port;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $pass;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $query;

    /**
     * Constructor
     *
     * @param string $uri
     * @param array $params (optional)
     */
    public function __construct($uri, array $params = [])
    {
        parent::__construct($params);
        $this->uri = $uri;
        $this->scheme = parse_url($uri, PHP_URL_SCHEME);
        $this->host = parse_url($uri, PHP_URL_HOST);
        $this->port = parse_url($uri, PHP_URL_PORT);
        $this->user = parse_url($uri, PHP_URL_USER);
        $this->pass = parse_url($uri, PHP_URL_PASS);
        $this->setPath(parse_url($uri, PHP_URL_PATH));
        $this->query = parse_url($uri, PHP_URL_QUERY);
    }

    /**
     * Returns the request uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Returns the uri scheme part
     *
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Returns the uri host part
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Returns the uri port part
     *
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Returns the uri user part
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Returns whether or not a uri path only has permitted characters
     *
     * @param string $path
     * @return boolean
     */
    private static function checkSafePath($path)
    {
        $permitted_path_chars = ConfigurationReader::get('permitted_path_chars');
        return preg_match("/^[$permitted_path_chars]+$/", $path);
    }

    /**
     * Sets the uri path part
     *
     * @param string $path
     * @return Request
     */
    private function setPath($path)
    {
        $path = strtolower(trim(urldecode($path)));
        $path = (substr($path, 0, 1) != '/') ? '/' . $path : $path;
        $path = (substr($path, -1) != '/') ? $path . '/' : $path;
        if (! self::checkSafePath($path)) {
            throw new \Exception(
                "The uri contains invalid characters."
            );
        }
        $this->path = $path;
        return $this;
    }

    /**
     * Returns the uri path part
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns the uri query part
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Returns whether or not a request is being sent over HTTPS
     *
     * @return boolean
     */
    public function isSecure()
    {
        return $this->getScheme() === 'https';
    }
}
