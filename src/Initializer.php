<?php

/**
 * @package    contao-feature-toggle
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\FeatureToggle;

use Netzmacht\Contao\FeatureToggle\Event\InitializeDefaultContextEvent;
use Netzmacht\Contao\FeatureToggle\Event\InitializeToggleCollectionEvent;
use Qandidate\Toggle\Context;
use Qandidate\Toggle\ToggleCollection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface as EventDispatcher;

/**
 * Initializer initializes all feature toggle related objects.
 */
class Initializer
{
    /**
     * The event dispatcher.
     *
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * Initializer constructor.
     *
     * @param EventDispatcher $eventDispatcher The event dispatcher.
     */
    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Initialize the toggle collection.
     *
     * @param ToggleCollection $collection Toggle collection.
     *
     * @return void
     */
    public function initializeToggleCollection(ToggleCollection $collection)
    {
        $event = new InitializeToggleCollectionEvent($collection);
        $this->eventDispatcher->dispatch($event::NAME, $event);
    }

    /**
     * Initialize the default context event.
     *
     * @param Context $context Feature context.
     *
     * @return void
     */
    public function initializeDefaultContext(Context $context)
    {
        $event = new InitializeDefaultContextEvent($context);
        $this->eventDispatcher->dispatch($event::NAME, $context);
    }
}
