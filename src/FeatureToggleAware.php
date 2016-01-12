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

/**
 * Simple access to the feature toggle handler.
 *
 * @package Netzmacht\Contao\FeatureToggle
 */
trait FeatureToggleAware
{
    /**
     * Get the feature toggle.
     *
     * @return mixed
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function getFeatureToggle()
    {
        return $GLOBALS['container']['feature-toggle'];
    }
}
