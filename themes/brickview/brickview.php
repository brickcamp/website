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
        // collect custom Twig functions
        $functions = [
            new \Twig_SimpleFunction( 'brick_term_image', [$this, 'getTermImage'] ),
            new \Twig_SimpleFunction( 'brick_terms', [$this, 'getTerms'] ),
        ];

        // make functions available in Twig templates
        foreach ($functions as $function) {
            $this->grav['twig']->twig->addFunction($function);
        }
    }

    public function getTerms( $taxonomy, $order_by='count', $order='desc' ) {
        $result = array();
        $terms = $this->grav['taxonomy']->taxonomy()[$taxonomy];
        
        foreach ( $terms as $term => $pages ) {
            $result[ $term ] = count( $pages );
        }

        $result = ($order == 'asc') ? asort( $result ) : arsort( $result );
        return array_keys( $result );
    }

    public function getTermImage( $taxonomy, $term, $ext='png' ) {
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
}