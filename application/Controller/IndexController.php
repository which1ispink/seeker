<?php
namespace App\Controller;

use Seeker\Controller\AbstractActionController;

/**
 * Example action controller
 */
class IndexController extends AbstractActionController
{
    public function index()
    {
        $view = $this->context->getView();
        $view->pass('name', 'Seeker')
             ->setTemplate('index');
    }
}
