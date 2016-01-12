<?php

/**
 * @package    contao-feature-toggle
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\FeatureToggle\Subscriber;

use Config;
use Netzmacht\Contao\FeatureToggle\Event\InitializeToggleCollectionEvent;
use Qandidate\Toggle\Serializer\ToggleSerializer;
use Qandidate\Toggle\ToggleCollection;

/**
 * Class ToggleCollectionInitializer.
 *
 * @package Netzmacht\Contao\FeatureToggle\Subscriber
 */
class ToggleCollectionInitializer
{
    /**
     * The toggle serializer.
     *
     * @var ToggleSerializer
     */
    private $toggleSerializer;

    /**
     * Contao config.
     *
     * @var Config
     */
    private $config;

    /**
     * ToggleCollectionInitializer constructor.
     *
     * @param ToggleSerializer $toggleSerializer Toggle serializer.
     * @param Config           $config           Contao config.
     */
    public function __construct(ToggleSerializer $toggleSerializer, Config $config)
    {
        $this->toggleSerializer = $toggleSerializer;
        $this->config           = $config;
    }

    /**
     * Handle the initialize toggle collection event.
     *
     * @param InitializeToggleCollectionEvent $event Subscribed event.
     *
     * @return void
     */
    public function handle(InitializeToggleCollectionEvent $event)
    {
        $collection = $event->getToggleCollection();

        foreach (Config::getInstance()->getActiveModules() as $module) {
            $this->importFromModule($module, $collection);
        }
    }

    /**
     * Import from module configuration.
     *
     * @param string           $module     The module name.
     * @param ToggleCollection $collection The toggle colleciton.
     *
     * @return void
     */
    private function importFromModule($module, ToggleCollection $collection)
    {
        $file = TL_ROOT . '/system/modules/' . $module . '/config/features.php';

        if (file_exists($file)) {
            $data = include $file;

            foreach ($data as $name => $serializedToggle) {
                $toggle = $this->toggleSerializer->deserialize($serializedToggle);
                $collection->set($name, $toggle);
            }
        }
    }
}
