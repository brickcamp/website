<?php

namespace Grav\Plugin\BrickCamp;

use Grav\Common\Grav;
use Grav\Common\Plugin;
use Grav\Plugin\BrickCamp\Tech\TechFunctions;

/**
 * Class CollectionFilter
 * @package Grav\Plugin\BrickCamp
 */
class CollectionFilter
{
    public const ROTATION = 'filter-rotations';

    private $form;

    private $grav;

    public static function byForm($form)
    {
        $filter = new self();
        $filter->form = $form;
        $filter->grav = Grav::instance();
        return $filter;
    }

    public static function getDefaultFor( $field )
    {
        $query = Grav::instance()['uri']->params(null, true);
        switch ($field) {
            case 'rotation_type':
                if (isset($query['function'])){
                    return $query['function'];
                }
                foreach ( TechFunctions::ROTATION_CHOICES as $type) {
                    if (isset($query[$type . '_angle'])) {
                        return $type;
                    }
                }
                return 'all';
            
            case 'rotation_angle':
                dump($query);
                if (isset($query['angle'])){
                    return $query['angle'];
                }
                foreach ( TechFunctions::ROTATION_CHOICES as $type) {
                    if (isset($query[$type . '_angle'])) {
                        return $query[$type . '_angle'];
                    }
                }
                return 'all';

            default:
                # code...
                break;
        }
    }

    public function submit()
    {
        switch ($this->form->name()) {
            // Rotation filters
            case self::ROTATION:
                $target = '/techs/rotation/';

                $angles = $this->form->value('rotation_angle');
                $angles = substr($angles,0,3) == 'all' ? 'all' : $angles;
                $type = $this->form->value('rotation_type');

                if ($type == 'all') {
                    if ($angles != 'all') {
                        $target .= 'angle:' . $angles;
                    }
                } else {
                    if ($angles != 'all') {
                        $target .= $type . '_angle:' . $angles;
                    } else {
                        $target .= 'function:' . $type;
                    }
                }

                $this->grav->redirect($target);

                return;
            default:
                return;
        }
    }
}
