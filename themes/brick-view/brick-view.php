<?php

namespace Grav\Theme;
use Grav\Common\Grav;
use Grav\Common\Theme;
use Grav\Common\Page\Pages;
use Grav\Common\Twig\Twig;

class BrickView extends Theme
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

        $this->enable([
            'onTwigExtensions' => ['onTwigExtensions', 0]
        ]);
    }

    public function onTwigExtensions()
    {
        $brickview_image = new \Twig_simpleFunction( 
            'brickview_image', function ( $taxonomy, $term, $ext='png' ) {
                // find existing folder
                $folder = $this->grav['page']->find('/images/tax-' . $taxonomy);
                if (!$folder) {
                    $folder = $this->grav['page']->find('/images');
                }

                // find image in folder
                $image = $folder->media()[$term . '.' . $ext];
                if ($image) { 
                    return $image;
                }

                $image = $folder->media()['no_image.png'];

                return $image;
            }
        );
        $this->grav['twig']->twig->addFunction($brickview_image);
    }
}
