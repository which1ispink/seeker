<?php
namespace Seeker\Controller;

use Seeker\Standard\ContextInterface;

/**
 * Abstract base class for action controllers
 */
abstract class AbstractActionController
{
    /**
     * @var ContextInterface
     */
    protected $context;
    
    /**
     * @var array $params
     */
    protected $params;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param array $params (optional)
     */
    public function __construct(ContextInterface $context, array $params = [])
    {
        $this->context = $context;
        $this->params = $params;
    }
}
