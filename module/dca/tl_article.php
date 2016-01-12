<?php

/**
 * @package    contao-feature-toggle
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

use Netzmacht\Contao\FeatureToggle\Dca\Options;

Bit3\Contao\MetaPalettes\MetaPalettes::appendFields('tl_article', 'expert', 'feature_toggle');

$GLOBALS['TL_DCA']['tl_article']['fields']['feature_toggle'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_article']['feature_toggle'],
    'inputType'        => 'select',
    'options_callback' => [Options::class, 'getToggles'],
    'reference'        => &$GLOBALS['TL_LANG']['feature_toggles'],
    'eval'             => [
        'chosen'             => true,
        'tl_class'           => 'w50',
        'includeBlankOption' => true,
    ],
    'sql'              => 'varchar(64) NOT NULL default \'\''
];
