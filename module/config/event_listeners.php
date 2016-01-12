<?php

use Netzmacht\Contao\FeatureToggle\Event\InitializeDefaultContextEvent;
use Netzmacht\Contao\FeatureToggle\Event\InitializeToggleCollectionEvent;

return [
    InitializeToggleCollectionEvent::NAME => [
        $GLOBALS['container']['feature-toggle.toggle-collection-initializer'], 'handle'
    ],
    InitializeDefaultContextEvent::NAME => [
        $GLOBALS['container']['feature-toggle.default-context-initializer'], 'handle'
    ]
];
