<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\FeatureToggle;

use Pimple;
use Qandidate\Toggle\Context;
use Qandidate\Toggle\ToggleManager;

/**
 * Class FeatureToggle is the entry point for the feature toggle api.
 *
 * @package Netzmacht\Contao\FeatureToggle
 */
class FeatureToggle
{
    /**
     * DI Container.
     *
     * @var Pimple
     */
    private $container;

    /**
     * FeatureToggle constructor.
     *
     * @param Pimple $container DI container.
     */
    public function __construct(Pimple $container)
    {
        $this->container = $container;
    }

    /**
     * Get the toggle manager.
     *
     * @return ToggleManager
     */
    public function getToggleManager()
    {
        return $this->container['feature-toggle.toggle-manager'];
    }

    /**
     * Create the default context.
     *
     * @return Context
     */
    public function createDefaultContext()
    {
        return $this->container['feature-toggle.default-context'];
    }
}
