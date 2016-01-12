<?php

/**
 * @package    contao-feature-toggle
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

use Netzmacht\Contao\FeatureToggle\Event\InitializeDefaultContextEvent;
use Netzmacht\Contao\FeatureToggle\Event\InitializeToggleCollectionEvent;

return [
    InitializeToggleCollectionEvent::NAME => [
        [$GLOBALS['container']['feature-toggle.toggle-collection-initializer'], 'handle']
    ],
    InitializeDefaultContextEvent::NAME => [
        [$GLOBALS['container']['feature-toggle.default-context-initializer'], 'handle']
    ]
];
