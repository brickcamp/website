<?php
namespace Grav\Plugin\BrickCamp;

use Grav\Common\Grav;
use Grav\Common\Page\Page;

abstract class Terms
{
    public const TITLES_FOLDER = DATA_DIR . 'brick-camp' . DIRECTORY_SEPARATOR;
    public const TITLES_EXTENSION = 'csv';
    
    private static $_nameList = [];

    public static function get($taxonomy, $order_by='title', $order='asc')
    {
        $result = array();
        $tax =  Grav::instance()['taxonomy']->taxonomy();
        if (!isset($tax[$taxonomy])) {
            return $result;
        }

        $terms = $tax[$taxonomy];
        foreach ($terms as $term => $pages) {
            switch ($order_by) {
                case 'count':
                    $result[ $term ] = count($pages);
                    break;
                
                case 'title':
                    $result[ $term ] = self::getTitle($taxonomy, $term);
                    break;
                
                default:
                    $result[ $term ] = $term;
                    break;
            }
        }

        if ($order == 'asc') {
            asort($result);
        } else {
            arsort($result);
        }
        return array_keys($result);
    }

    public function getImage($taxonomy, $term, $ext='png')
    {
        // try specific folder
        $folder = Grav::instance()['page']->find('/images/tax-' . strtolower($taxonomy));
        if ($folder) {

            // with specific image
            $image = $folder->media()[$term . '.' . $ext];
            if ($image) {
                return $image;
            }

            // if part: without letter-suffix
            if ($taxonomy == 'part') {
                preg_match('/(\d*)\D*/', $term, $part);
                if (isset($part[1])) {
                    $image = $folder->media()[$part[1] . '.' . $ext];
                    if ($image) {
                        return $image;
                    }
                }
            }

            // else: generic image
            $image = $folder->media()['no_image.png'];
            if ($image) {
                return $image;
            }
        }

        // else try generic folder
        $folder = Grav::instance()['page']->find('/images');
        if ($folder) {
            // with specific image
            $image = $folder->media()[$term . '.' . $ext];
            if ($image) {
                return $image;
            }

            // else: generic image
            return $folder->media()['no_image.png'];
        }
    }

    public function getTitle($taxonomy, $term)
    {
        // cache title list if necessary
        if (! isset(self::$_nameList[$taxonomy])) {
            $file = self::TITLES_FOLDER . $taxonomy . '.' . self::TITLES_EXTENSION;
            self::$_nameList[$taxonomy] = is_file($file) ? file_get_contents($file) : '';
        }

        // no titles -> return formatted key
        if (self::$_nameList[$taxonomy] == '') {
            return ucwords($term);
        }

        // search for title (in quotes or between commata)
        $pattern = '/^' . preg_quote($term, '/') . ',(?:"([^"]+)"|([^",]+)).*$/m';
        if (preg_match($pattern, self::$_nameList[$taxonomy], $match)) {
            return (! empty($match[1])) ? $match[1] : $match[2];
        } else {
            return ucwords($term);
        }
    }

    public static function initTermPages($taxonomy, $parent) {
        $pages = Grav::instance()['pages'];
        $path = $pages->find($parent)->path();
        $terms = self::get($taxonomy);

        foreach ($terms as $term) {
            // check whether term page already exists
            $route = $parent . '/' . $term;
            $page = $pages->find($route);
            if ($page) {
                continue;
            }

            // create file for page
            $page = new Page;
            $page->filePath($path . DIRECTORY_SEPARATOR . $term . DIRECTORY_SEPARATOR . 'collection.md');
            $page->header( array(
                'title' => self::getTitle($taxonomy, $term),
                'image' => 'image.png',
                'icon' => 'image.png',
                'content' => array(
                    'items' => array(
                        '@taxonomy.' . $taxonomy => $term
                    ),
                    'limit' => 12,
                    'pagination' => true
                )
            ));
            $media = $page->media();
            $media->add('image.png', self::getImage($taxonomy, $term));
            $page->media($media);

            // add to pages
            $pages->addPage($page, $route);
            $page->save();
        }
    }
}