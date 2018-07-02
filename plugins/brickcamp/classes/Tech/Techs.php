<?php
namespace Grav\Plugin\Brickcamp\Tech;
use Grav\Plugin\BrickCamp\Tech\TechFunctions;

abstract class Techs {

    public static function addTermGroups( $tech )
    {
        // get current taxonomies
        $pagetax = $tech->taxonomy();

        // add group terms
        foreach (TechFunctions::TERM_GROUPS as $taxonomy => $groups) {
            if (!isset($pagetax[$taxonomy])) {
                continue;
            }

            $add = array();
            foreach ($pagetax[$taxonomy] as $term) {
                foreach ($groups as $group) {
                    if ($term >= $group[0] && $term <= $group[1]) {
                        $add[$group[2]] = true;
                    }
                    unset($add[$term]);
                }
            }
            $pagetax[$taxonomy] = array_merge($pagetax[$taxonomy], array_keys($add));
        }

        // update taxonomies and terms
        $tech->taxonomy($pagetax);
    }

    public static function addTaxonomyGroups( $tech )
    {
        // get current taxonomies
        $pagetax = $tech->taxonomy();

        // add group taxonomies
        foreach (TechFunctions::TAX_GROUPS as $tax_group => $taxonomies) {
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
}