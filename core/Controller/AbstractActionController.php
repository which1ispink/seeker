<?php
namespace Seeker\Controller;

use Seeker\Standard\ContextInterface;

/**
 * Abstract base class for action controllers
 */
abstract class AbstractActionController implements ActionControllerInterface
{
    /**
     * @var array $params
     */
    protected $params = [];

    /**
     * Constructor
     *
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * Executes the action controller
     *
     * @param ContextInterface $context
     * @return void
     */
    abstract public function execute(ContextInterface $context);
}
