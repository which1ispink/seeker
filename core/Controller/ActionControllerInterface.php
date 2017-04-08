<?php
namespace Seeker\Controller;

use Seeker\Standard\ContextInterface;

/**
 * Interface for action controllers
 */
interface ActionControllerInterface
{
    /**
     * Executes the action controller
     *
     * @param ContextInterface $context
     * @return void
     */
    public function execute(ContextInterface $context);
}
