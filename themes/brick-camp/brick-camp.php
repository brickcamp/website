<?php

namespace Grav\Theme;
use Grav\Common\Grav;
use Grav\Common\Theme;
use Grav\Common\Page\Pages;
use Grav\Common\Twig\Twig;
use RocketTheme\Toolbox\Event\Event;

class BrickCamp extends Theme
{
    public static function getSubscribedEvents()
    {
        return [
            'onThemeInitialized' => ['onThemeInitialized', 0]
        ];
    }

    public function onThemeInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;
            return;
        }

        // Enable the main event we are interested in
        $this->enable([
            'onPageContentProcessed' => ['onPageContentProcessed', 0],
        ]);
    }
      
    /**
     * Add bootstrap classes to markdown results
     * @param Event $event
     * @return void
     */
    public function onPageContentProcessed(Event $event) 
    {
        $page = $event['page'];
        $raw_content = $page->content();
        $raw_content = preg_replace('/<table>/', '<div class="table-responsive"><table class="table table-sm table-striped table-bordered text-center">', $raw_content);
        $raw_content = preg_replace('/<th>/', '<th scope="col">', $raw_content);
        $raw_content = preg_replace('/<tr>[^<]*<td>([^<]*)<\/td>/', '<tr><th scope="col">$1</th>', $raw_content);
        $raw_content = preg_replace('/<\/table>/', '</table></div>', $raw_content);
        $page->setRawContent($raw_content);
    }
}