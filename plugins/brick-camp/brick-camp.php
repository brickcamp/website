<?php
namespace Grav\Plugin;

use Grav\Common\Grav;
use Grav\Common\Plugin;
use Grav\Common\Uri;
use Grav\Plugin\BrickCamp\Techs;
use Grav\Plugin\BrickCamp\TermsTwigExtension;
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
        // Increase php execution time
        ini_set('max_execution_time', 300);

        // Don't proceed if we are in the admin view
        if ($this->isAdmin()) {
            return;
        }

        // autoload subclasses when needed
        include_once __DIR__ . '/classes/autoload.php';

        // subscribe to needed events
        $this->enable([
            'onTwigExtensions' => ['onTwigExtensions', 0],
            'onFormInitialized' => ['onFormInitialized', 0],
            // 'onFormProcessed' => ['onFormProcessed', 0],
            'onPageProcessed' => ['onPageProcessed', 0],
            'onCollectionProcessed' => ['onCollectionProcessed', 0],
        ]);
    }

    /**
     * Initialize the Twig Exensions for querying information in template files
     */
    public function onTwigExtensions()
    {
        $this->grav['twig']->twig->addExtension(new TermsTwigExtension);
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
            $this->grav['assets']->addJs('plugin://brick-camp/assets/items-filter.js', 110);
        }
    }

    public function onPageProcessed(Event $event)
    {
        $page = $event['page'];
        if ($page->template() == 'tech') {
            Techs::onPageProcessed($page);
        }
    }

    /**
     * Edit collections based on URI
     *
     * @param Event $event
     * @return void
     */
    public function onCollectionProcessed(Event $event)
    {
        $collection = $event['collection'];
        $params = $collection->params();

        if (isset($params['url_taxonomy_filters'])) {
            $process_taxonomy = $params['url_taxonomy_filters'];
        } else {
            $process_taxonomy = $this->grav['config']->get('system.pages.url_taxonomy_filters');
        }
        
        if ($process_taxonomy) {
            $orderby = $this->grav['uri']->param('orderby');
            $orderdir = $this->grav['uri']->param('orderdir');
        
            if ($orderby) {
                $collection->order($orderby, $orderdir ?: 'asc');
            } elseif ($orderdir) {
                $collection->order('default', $orderdir);
            }
        }
    }
}
