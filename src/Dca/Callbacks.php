<?php

/**
 * @package    contao-feature-toggle
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\FeatureToggle\Dca;

use Bit3\Contao\MetaPalettes\MetaPalettes;
use DataContainer;
use Netzmacht\Contao\FeatureToggle\FeatureToggleAware;

/**
 * Class Options.
 *
 * @package Netzmacht\Contao\FeatureToggle\Dca
 */
class Callbacks
{
    use FeatureToggleAware;

    /**
     * Mapping between table and the corresponding visibility palette.
     *
     * @var array
     */
    private $legendMapping = [
        'tl_content' => 'invisible',
        'tl_module' => 'expert'
    ];

    /**
     * Get all feature toggles.
     *
     * @return array
     */
    public function getToggles()
    {
        return array_keys($this->getFeatureToggle()->getToggleManager()->all());
    }

    /**
     * Add the toggle feature field to the palette.
     *
     * @param DataContainer $dataContainer Data container driver.
     *
     * @return void
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function addToggleFeatureField(DataContainer $dataContainer)
    {
        if (!isset($this->legendMapping[$dataContainer->table])) {
            return;
        }

        foreach ($GLOBALS['TL_DCA'][$dataContainer->table]['palettes'] as $name => $palette) {
            if (is_array($palette)) {
                continue;
            }

            MetaPalettes::appendFields(
                $dataContainer->table,
                $name,
                $this->legendMapping[$dataContainer->table],
                ['feature_toggle']
            );
        }
    }
}
