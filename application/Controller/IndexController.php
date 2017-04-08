<?php
namespace App\Controller;

use Seeker\Controller\AbstractActionController;
use Seeker\Standard\ContextInterface;

/**
 * Example action controller
 */
class IndexController extends AbstractActionController
{
    /**
     * Executes the action controller
     *
     * @param ContextInterface $context
     * @return void
     */
    public function execute(ContextInterface $context)
    {
        $context->getView()
                ->pass('name', 'Seeker')
                ->setTemplate('index');
    }
}
