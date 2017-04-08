<?php
namespace Seeker\View;

/**
 * Standard PHP template view. Used if no default template engine adapter is specified in config
 */
class View extends AbstractView
{
    /**
     * @var string
     */
    protected $fileExtension = '.php';

    /**
     * Renders the view
     *
     * @return void
     */
    public function render()
    {
        foreach ($this->values as $name => $value) {
            $$name = $value;
        }
        include $this->viewsPath . '/' . $this->getTemplate();
    }
}
