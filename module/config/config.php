<?php

/**
 * @package    contao-feature-toggle
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

$GLOBALS['TL_HOOKS']['isVisibleElement'][] = [
    'Netzmacht\Contao\FeatureToggle\Subscriber\VisibilitySubscriber',
    'handleIsVisibleElement'
];

$GLOBALS['TL_HOOKS']['generatePage'][] = [
    'Netzmacht\Contao\FeatureToggle\Subscriber\VisibilitySubscriber',
    'handleGeneratePage'
];
