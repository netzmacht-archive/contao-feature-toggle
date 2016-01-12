<?php

/**
 * @package    contao-feature-toggle
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\FeatureToggle\Event;

use Qandidate\Toggle\Context;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class InitializeContextEvent.
 *
 * @package Netzmacht\Contao\FeatureToggle\Event
 */
class InitializeDefaultContextEvent extends Event
{
    const NAME = 'feature-toggle.initialize-default-context';

    /**
     * Feature context.
     *
     * @var Context
     */
    private $context;

    /**
     * InitializeContextEvent constructor.
     *
     * @param Context $context Feature context.
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * Get context.
     *
     * @return Context
     */
    public function getContext()
    {
        return $this->context;
    }
}
