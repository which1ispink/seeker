<?php
namespace App\TemplateEngine\Adapter;

use Seeker\View\AbstractView;
use Philo\Blade\Blade as BladeTemplateEngine;

/**
 * An adapter for the Blade template engine, to allow using it as the application view component
 */
class Blade extends AbstractView
{
    /**
     * @var Blade
     */
    private $blade;

    /**
     * Constructor
     *
     * @param Blade $blade
     */
    public function __construct(BladeTemplateEngine $blade)
    {
        parent::__construct();
        $this->blade = $blade;
    }

    /**
     * Renders the Blade template
     *
     * @return string
     */
    public function render()
    {
        return $this->blade->view()
                           ->make($this->getTemplate(), $this->values)
                           ->render();
    }
}
