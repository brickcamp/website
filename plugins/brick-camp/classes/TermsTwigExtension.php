<?php
namespace Grav\Plugin\BrickCamp;

use Grav\Common\Grav;
use Grav\Common\Uri;
use Grav\Plugin\BrickCamp\Terms;
use Grav\Plugin\BrickCamp\Techs;

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
            new \Twig_SimpleFunction( 'brick_functions', [ $this, 'getTechFunctions'] ),
            new \Twig_SimpleFunction( 'brick_function_value_url', [ $this, 'getFunctionValueUrl'] ),
            new \Twig_SimpleFunction( 'brick_function_value', [ $this, 'getFunctionValue'] ),
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

    public function getTechFunctions($tech) {
        return Techs::getFunctions($tech);
    }

    public function getFunctionValueUrl($taxonomy, $value) {
        return Techs::getFunctionValueUrl($taxonomy, $value);
    }

    public function getFunctionValue($taxonomy, $value) {
        return Techs::getFunctionValue($taxonomy, $value);
    }
}
