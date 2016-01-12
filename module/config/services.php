<?php

/**
 * @package    contao-feature-toggle
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

use Netzmacht\Contao\FeatureToggle\FeatureToggle;
use Netzmacht\Contao\FeatureToggle\Initializer;
use Netzmacht\Contao\FeatureToggle\Subscriber\DefaultContextInitializer;
use Netzmacht\Contao\FeatureToggle\Subscriber\ToggleCollectionInitializer;
use Qandidate\Toggle\Context;
use Qandidate\Toggle\Serializer\OperatorConditionSerializer;
use Qandidate\Toggle\Serializer\OperatorSerializer;
use Qandidate\Toggle\Serializer\ToggleSerializer;
use Qandidate\Toggle\ToggleCollection\InMemoryCollection;
use Qandidate\Toggle\ToggleManager;

global $container;

$container['feature-toggle.initializer'] = $container->share(
    function ($container) {
        return new Initializer($container['event-dispatcher']);
    }
);

$container['feature-toggle.toggle-collection'] = $container->share(
    function ($container) {
        /** @var Initializer $initializer */
        $initializer = $container['feature-toggle.initializer'];
        $collection  = new InMemoryCollection();

        $initializer->initializeToggleCollection($collection);

        return $collection;
    }
);

$container['feature-toggle.default-context'] = function ($container) {
    if (!isset($container['feature-toggle.default-context.instance'])) {
        /** @var Initializer $initializer */
        $initializer = $container['feature-toggle.initializer'];
        $context     = new Context();

        $initializer->initializeDefaultContext($context);
        $container['feature-toggle.default-context.instance'] = $context;
    }

    return clone $container['feature-toggle.default-context.instance'];
};

$container['feature-toggle.toggle-manager'] = $container->share(
    function ($container) {
        $collection = $container['feature-toggle.toggle-collection'];
        $manager    = new ToggleManager($collection);

        return $manager;
    }
);

$container['feature-toggle.toggle-serializer'] = $container->share(
    function () {
        $serializer = new ToggleSerializer(
            new OperatorConditionSerializer(
                new OperatorSerializer()
            )
        );

        return $serializer;
    }
);

$container['feature-toggle.toggle-collection-initializer'] = $container->share(
    function ($container) {
        $initializer = new ToggleCollectionInitializer(
            $container['feature-toggle.toggle-serializer'],
            $container['config']
        );

        return $initializer;
    }
);

$container['feature-toggle.default-context-initializer'] = $container->share(
    function ($container) {
        return new DefaultContextInitializer($container['user']);
    }
);

$container['feature-toggle'] = $container->share(
    function ($container) {
        return new FeatureToggle($container);
    }
);
