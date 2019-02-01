<?php
namespace Grav\Plugin\BrickCamp\Twig;

use Grav\Common\Grav;
use Grav\Common\Uri;
use Grav\Plugin\BrickCamp\Taxonomy\Terms;
use Grav\Plugin\BrickCamp\Posttype\Techs;

class TermsTwigExtension extends \Twig_Extension
{
    /**
     * @var Grav
     */
    protected $grav;

    public function __construct()
    {
        $this->grav = Grav::instance();
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction( 'brick_terms', [ $this, 'getTerms'] ),
            new \Twig_SimpleFunction( 'brick_term_title', [ $this, 'getTermTitle'] ),
            new \Twig_SimpleFunction( 'brick_term_image', [ $this, 'getTermImage'] ),
            new \Twig_SimpleFunction( 'brick_collection', [ $this, 'getCollectionAsPseudoPage'] ),
            new \Twig_SimpleFunction( 'brick_functions', [ $this, 'getTechFunctions'] ),
        ];
    }

    public function getTerms($taxonomy, $order_by='title', $order='asc')
    {
        return Terms::get($taxonomy, $order_by, $order);
    }

    public function getTermTitle($taxonomy, $term) 
    {
        return Terms::getTitle($taxonomy, $term);
    }

    public function getTermImage($taxonomy, $term, $ext='png') 
    {
        return Terms::getImage($taxonomy, $term, $ext);
    }

    public function getCollectionAsPseudoPage($args, $page = null) {
        if(!isset($page)) {
            $page = $this->grav['page'];
        }

        $collection = $page->collection($args['collection']);
        return [
            'template'   => 'collection',
            'slug'       => array_key_exists('slug', $args) ? $args['slug'] : '',
            'url'        => $this->grav['uri']->rootUrl(true) . '/' . $args['route'],
            'title'      => array_key_exists('title', $args) ? $args['title'] : '',
            'content'    => array_key_exists('content', $args) ? $args['content'] : '',
            'collection' => $collection,
        ];
    }

    public function getTechFunctions($tech) {
        return Techs::getFunctions($tech);
    }
}
