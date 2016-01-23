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

use Model;
use Netzmacht\Contao\FeatureToggle\FeatureToggleAware;
use PageModel;
use Qandidate\Toggle\Context;
use Template;

/**
 * Class VisibilitySubscriber applies the toggle to Contao pages, articles, modules and content elements.
 *
 * @package Netzmacht\Contao\FeatureToggle\Subscriber
 */
class VisibilitySubscriber
{
    use FeatureToggleAware;

    /**
     * Apply feature toggle for modules, articles and content elements by using the isVisibleElement hook.
     *
     * @param Model $model     The model.
     * @param bool  $isVisible Visibility state.
     *
     * @return bool|True
     */
    public function handleIsVisibleElement(Model $model, $isVisible)
    {
        if (!$isVisible) {
            return false;
        }

        if ($model->feature_toggle) {
            $context = $this->getContextForModel($model);

            return $this->getFeatureToggle()->getToggleManager()->active($model->feature_toggle, $context);
        }

        return $isVisible;
    }

    /**
     * Handle page visibility by hooking into the generatePage hook.
     *
     * @param PageModel $pageModel Page model.
     *
     * @return void
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function handleGeneratePage(PageModel $pageModel)
    {
        if (!$pageModel->feature_toggle) {
            return;
        }

        $context = $this->getContextForModel($pageModel);
        if ($this->getFeatureToggle()->getToggleManager()->active($pageModel->feature_toggle, $context)) {
            return;
        }

        // Page is disabled by the feature, show 404 page.
        $errorPage = $GLOBALS['TL_PTY']['error_404'];
        $handler   = new $errorPage();

        $handler->generate($pageModel->id);
    }

    /**
     * Filter deactivated navigation items when navigation template is being parsed.
     *
     * @param Template $template Template being parsed.
     *
     * @return void
     */
    public function filterNavigationItems(Template $template)
    {
        if (substr($template->getName(), 0, 4) !== 'nav_' || !is_array($template->items)) {
            return;
        }

        $toggleManager = $this->getFeatureToggle()->getToggleManager();
        $context       = $this->getFeatureToggle()
            ->createDefaultContext()
            ->set('type', 'module')
            ->set('module_id', $template->id)
            ->set('module_type', $template->type);

        $template->items = array_filter(
            $template->items,
            function ($item) use ($toggleManager, $context) {
                if (empty($item['feature_toggle'])) {
                    return true;
                }

                $context->set('page_id', $item['id']);

                return $toggleManager->active($item['feature_toggle'], $context);
            }
        );
    }

    /**
     * Get the toggle context for the given model.
     *
     * @param Model $model The model.
     *
     * @return Context
     */
    private function getContextForModel(Model $model)
    {
        $context = $this->getFeatureToggle()->createDefaultContext();
        $context->set('model_table', $model->getTable());
        $context->set('model_id', $model->id);

        return $context;
    }
}
