<?php
namespace Seeker\View;

/**
 * Interface for the application view component
 */
interface ViewInterface
{
    /**
     * Renders the view
     *
     * @return mixed
     */
    public function render();

    /**
     * Passes variables to the view
     *
     * @param string $name
     * @param mixed $value (optional)
     * @return mixed
     */
    public function pass($name, $value = null);

    /**
     * Returns passed variables to the view
     *
     * @return array
     */
    public function getPassedValues();

    /**
     * Sets the template to be used
     *
     * @param string $template
     * @return mixed
     */
    public function setTemplate($template);

    /**
     * Returns the template to be used
     *
     * @return string
     */
    public function getTemplate();

    /**
     * Sets the templates file extension
     *
     * @param string $fileExtension
     * @return mixed
     */
    public function setFileExtension($fileExtension);

    /**
     * Returns the templates file extension
     *
     * @return string
     */
    public function getFileExtension();
}
