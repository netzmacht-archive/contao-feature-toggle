<?php

/**
 * @package    contao-feature-toggle
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\FeatureToggle\Event;

use Qandidate\Toggle\ToggleCollection;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class InitializeFeatureCollectionEvent is emitted when all feature toggle definitions get collected.
 *
 * @package Netzmacht\Contao\FeatureToggle\Event
 */
class InitializeToggleCollectionEvent extends Event
{
    const NAME = 'feature-toggle.initialize-toggle-collection';

    /**
     * The feature collection.
     *
     * @var ToggleCollection
     */
    private $toggleCollection;

    /**
     * InitializeFeatureCollectionEvent constructor.
     *
     * @param ToggleCollection $collection The toggle collection.
     */
    public function __construct(ToggleCollection $collection)
    {
        $this->toggleCollection = $collection;
    }

    /**
     * Get the toggle collection.
     *
     * @return ToggleCollection
     */
    public function getToggleCollection()
    {
        return $this->toggleCollection;
    }
}
