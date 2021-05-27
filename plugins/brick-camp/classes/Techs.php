<?php
namespace Grav\Plugin\BrickCamp;

use Grav\Common\Grav;
use Grav\Plugin\BrickCamp\Functions;

abstract class Techs {

    /**
     * Conversion factors: each Units in LDU
     */
    public const LENGTH_UNITS = array(
        'ldu'    => 1,
        'plate'  => 8,
        'plates' => 8,
        'stud'   => 20,
        'studs'  => 20,
        'brick'  => 24,
        'bricks' => 24,
        'track'  => 320,
        'tracks' => 320,

        'mm'     => 2.5047,
        'cm'     => 25.0470,
        'dm'     => 250.4696,
        'm'      => 2504.6963,

        'in'     => 63.6193,
        'inch'   => 63.6193,
        'ft'     => 763.4314,
        'foot'   => 763.4314,
        'yd'     => 2290.2943,
        'yard'   => 2290.2943,
    );

    public static function onPageProcessed($tech) {
        self::addVolumeTaxonomy($tech);
        self::addSourceTaxonomy($tech);
        self::addTermGroups($tech);
        self::addTaxonomyGroups($tech);
        }

    public static function addVolumeTaxonomy( $tech ){
        // check obligatory header fields
        $pagetax = $tech->taxonomy();
        if (!isset($pagetax['width']) || 
            !isset($pagetax['depth']) || 
            !isset($pagetax['height'])) {
            return;
        }

        // calculate volume
        $width  = $pagetax['width'][0] * self::LENGTH_UNITS[$pagetax['width'][1]];
        $depth  = $pagetax['depth'][0] * self::LENGTH_UNITS[$pagetax['depth'][1]];
        $height = $pagetax['height'][0] * self::LENGTH_UNITS[$pagetax['height'][1]];
        $volume = $width * $depth * $height;
        
        // set volume as header field
        $header = $tech->header();
        $header->volume = $volume;
        $tech->header($header);
    }

    public static function addSourceTaxonomy( $tech ){
        // check for source url
        $header = $tech->header();
        if ( ! isset($header->source) ){
            return;
        }

        $source = (array)$header->source;
        if ( ! isset($source['url']) ){
            return;
        }

        // set host as source taxonomy term
        $pagetax = $tech->taxonomy();
        $domain = parse_url($source['url'], PHP_URL_HOST);
        if (substr( $domain, 0, 4 ) === "www.") {
            $domain = substr( $domain, 4);
        }
        $pagetax['source'][] = $domain;
        $tech->taxonomy($pagetax);
    }

    /**
     * adds custom term groups e.g. 81° -> 0-90°
     *
     * @param Page $tech Tech to add term groups to
     * @return void
     */
    public static function addTermGroups( $tech )
    {
        // get current taxonomies
        $pagetax = $tech->taxonomy();

        // add group terms
        foreach (Functions::TERM_GROUPS as $taxonomy => $groups) {
            if (!isset($pagetax[$taxonomy])) {
                continue;
            }

            $add = array();
            foreach ($pagetax[$taxonomy] as $key=>$term) {
                foreach ($groups as $group) {
                    if ($term >= $group[0] && $term <= $group[1]) {
                        $add[Functions::TERM_GROUP_PREFIX . $group[2]] = true;
                    }
                    //unset($add[$term]);
                }
            }
            $pagetax[$taxonomy] = array_merge($pagetax[$taxonomy], array_keys($add));
        }

        // update taxonomies and terms
        $tech->taxonomy($pagetax);
    }

    /**
     * adds custom taxonomy groups e.g. stud_tilt_angle -> angle
     *
     * @param Page $tech Tech to add taxonomy groups to
     * @return void
     */
    public static function addTaxonomyGroups( $tech )
    {
        // get current taxonomies
        $pagetax = $tech->taxonomy();

        // add group taxonomies
        foreach (Functions::TAX_GROUPS as $tax_group => $taxonomies) {
            $add = array();
            foreach ($taxonomies as $taxonomy) {
                if (!isset($pagetax[$taxonomy])) {
                    continue;
                }

                foreach ($pagetax[$taxonomy] as $term) {
                    $add[$term] = true;
                }
            }
            if( empty($add)) {
                continue;
            }
            $pagetax[$tax_group] = array_keys($add);
        }

        // update taxonomies and terms
        $tech->taxonomy($pagetax);
    }

    /**
     * Summarizes functions of a tech by combining the different 
     * function-related taxonomies/terms
     *
     * @param Page $tech Tech to get functions from
     * @return array List of functions and their values
     */
    public static function getFunctions( $tech ) {
        $pagetax = $tech->taxonomy();
        $result = array();

        // check for functions
        if (!isset($pagetax[Functions::TAXONOMY])) {
            return;
        }

        // for each possible function
        foreach ($pagetax[Functions::TAXONOMY] as $function) {
            // get all relevant taxonomies
            $taxonomies = Functions::TAXONOMIES[$function];
            if (!is_array($taxonomies)) {
                $taxonomies = [$taxonomies];
            }

            // add non-generated terms to result
            foreach ($taxonomies as $taxonomy) {
                $result[$function][$taxonomy] = array_filter(
                    $pagetax[$taxonomy], 
                    function($term){
                        return self::isOriginalTerm($term);
                    }
                );
            }
        }

        return $result;
    }

    public static function getFunctionValueUrl( $taxonomy, $value ) {

        $url_value = urlencode($value);
        $param_separator = Grav::instance()['config']->get('system.param_sep');

        if($taxonomy == 'part') {
            return "/techs/using/" . $taxonomy . $param_separator . $url_value;
        }

        if (in_array($taxonomy, Functions::ROTATION_ANGLES)) {
            return "/techs/rotations/" . $taxonomy . $param_separator . $url_value;
        }

        if (in_array($taxonomy, Functions::OFFSET_LENGTHS)) {
            return "/techs/offsets/" . $taxonomy . $param_separator . $url_value;
        }

        if (in_array($taxonomy, Functions::SHAPE_SEGMENTS) || 
            in_array($taxonomy, Functions::SHAPE_SEGSIZE)) {
            return "/techs/shapes/" . $taxonomy . $param_separator . $url_value;
        }

        if (in_array($taxonomy, Functions::PATTERN_SEGSIZE)) {
            return "/techs/patterns/" . $taxonomy . $param_separator . $url_value;
        }

        return "/techs/with/" . $taxonomy . $param_separator . $url_value;
    }

    public static function getFunctionValue( $taxonomy, $value ) {
        $language = Grav::instance()['language'];

        if (in_array($taxonomy, Functions::ROTATION_ANGLES)) {
            return $value . "°";
        }

        if (in_array($taxonomy, Functions::OFFSET_LENGTHS)) {
            if ($value == "flex") {
                return $language->translate(['TAXONOMY.VALUE.FLEX']);
            }
            return $value . " LDU";
        }

        if (in_array($taxonomy, Functions::SHAPE_SEGMENTS)) {
            return $value . " x ";
        }

        if (in_array($taxonomy, Functions::SHAPE_SEGSIZE) ||
            in_array($taxonomy, Functions::PATTERN_SEGSIZE)) {
            return $value . " " . $language->translate(['TECH.PARTS']);
        }

        if ($taxonomy == Functions::MODULE_TYPE) {
            return ucfirst($value);
        }

        return $value;
    }

    /**
     * Determines whether term was automatically generated
     *
     * @param String $term the term
     * @return boolean true if auto-generated
     */
    private static function isGeneratedTerm( $term ) {
        return substr($term, 0, 1) == Functions::TERM_GROUP_PREFIX;
    }


    /**
     * Determines whether term was automatically generated
     *
     * @param String $term the term
     * @return boolean true if auto-generated
     */
    private static function isOriginalTerm( $term ) {
        return !self::isGeneratedTerm($term);
    }
}