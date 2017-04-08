<?php
namespace Seeker\View;

use Seeker\Standard\ConfigurationReader;

/**
 * Abstract base class for the application view component
 */
abstract class AbstractView implements ViewInterface
{
    /**
     * @var array
     */
    protected $values = [];

    /**
     * @var string
     */
    protected $template;

    /**
     * @var string
     */
    protected $fileExtension = ''; // Include the '.' if overriden by a non-empty value

    /**
     * @var string
     */
    protected $viewsPath;

    /**
     * @var string
     */
    protected $cachePath;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->setFileExtension($this->fileExtension);
        $this->viewsPath = ConfigurationReader::get('views_path');
        $this->cachePath = ConfigurationReader::get('cache_path');
    }

    /**
     * Renders the view
     *
     * @return mixed
     */
    abstract public function render();

    /**
     * Passes variables to the view
     *
     * @param string $name
     * @param mixed $value (optional)
     * @return mixed
     */
    public function pass($nameOrValue, $value = null)
    {
        if (is_array($nameOrValue)) {
            array_walk($nameOrValue, [$this, 'pass']);
        }
        $this->values[$nameOrValue] = $value;
        return $this;
    }

    /**
     * Returns passed variables to the view
     *
     * @return array
     */
    public function getPassedValues()
    {
        return $this->values;
    }

    /**
     * Sets the template to be used
     *
     * @param string $template
     * @return mixed
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * Returns the template to be used
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template . $this->fileExtension;
    }

    /**
     * Sets the templates file extension
     *
     * @param string $fileExtension
     * @return mixed
     */
    public function setFileExtension($fileExtension)
    {
        $this->fileExtension = $fileExtension;
        return $this;
    }

    /**
     * Returns the templates file extension
     *
     * @return string
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }
}
