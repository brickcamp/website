<?php
namespace Grav\Plugin;

use Grav\Common\Grav;
use Grav\Common\Plugin;
use Grav\Plugin\BrickCamp\Tech\Techs;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class BrickCampPlugin
 * @package Grav\Plugin
 */
class BrickCampPlugin extends Plugin
{

    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => [
                ['onPluginsInitialized', 0],
            ],
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin view
        if ($this->isAdmin()) {
            return;
        }

        // autoload subclasses when needed
        require_once __DIR__ . '/classes/autoload.php';

        // subscribe to needed events
        $this->enable([
            'onFormInitialized' => ['onFormInitialized', 0],
            'onPageProcessed' => ['onPageProcessed', 0],
        ]);
    }

    /**
     * Initialize Filter Forms
     *
     * @param Event $event
     * @return void
     */
    public function onFormInitialized(Event $event)
    {
        $form = $event['form'];

        // autofill form with URL filters
        if (substr($form->name(), 0, 6) == 'filter') {
            $this->grav['assets']->addJs('plugin://brickcamp/assets/items-filter.js', 110);
        }
        // dump(TechFunctions::ANGLE_GROUPS);
    }

    public function onPageProcessed(Event $event)
    {
        $page = $event['page'];
        if ($page->template() == 'tech') {
            Techs::addTermGroups( $page );
            Techs::addTaxonomyGroups( $page );
        }
    }
}
