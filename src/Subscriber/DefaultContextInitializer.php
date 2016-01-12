<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\FeatureToggle\Subscriber;

use Netzmacht\Contao\FeatureToggle\Event\InitializeDefaultContextEvent;
use User;

/**
 * Class DefaultContextInitializer.
 *
 * @package Netzmacht\Contao\FeatureToggle\Subscriber
 */
class DefaultContextInitializer
{
    /**
     * Contao user.
     *
     * @var User
     */
    private $user;

    /**
     * DefaultContextInitializer constructor.
     *
     * @param User $user The Contao user.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Initialize the context.
     * 
     * @param InitializeDefaultContextEvent $event
     */
    public function handle(InitializeDefaultContextEvent $event)
    {
        $context = $event->getContext();
        $context->set('tl_mode', TL_MODE);
        
        if (isset($GLOBALS['objPage'])) {
            $context->set('page_id', $GLOBALS['objPage']->id);
        }
        
        $context->set('fe_user_logged_in', FE_USER_LOGGED_IN === TRUE);
        $context->set('be_user_logged_in', BE_USER_LOGGED_IN === TRUE);
        
        if ($this->user->id) {
            $context->set('user_id', $this->user->id);
        }
    }
}
