<?php

namespace Grav\Theme;
use Grav\Common\Grav;
use Grav\Common\Theme;
use Grav\Common\Page\Pages;
use Grav\Common\Twig\Twig;

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
    }
}