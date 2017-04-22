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
        $this->getView()->pass('name', 'Seeker')
                        ->setTemplate('index');
    }
}
