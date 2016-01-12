<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\FeatureToggle\Dca;

use Netzmacht\Contao\FeatureToggle\FeatureToggleAware;

/**
 * Class Options.
 *
 * @package Netzmacht\Contao\FeatureToggle\Dca
 */
class Options
{
    use FeatureToggleAware;

    /**
     * Get all feature toggles.
     *
     * @return array
     */
    public function getToggles()
    {
        return array_map(
            function ($feature) {
                return $feature['name'];
            },
            $this->getFeatureToggle()->getToggleManager()->all()
        );
    }
}
