<?php
namespace Grav\Plugin\Brickcamp\Tech;

abstract class TechFunctions {

    // Automatically generated taxonomy terms
    public const TERM_GROUPS = array(
        self::STUD_TILT_ANGLE  => self::ANGLE_GROUPS,
        self::STUD_TWIST_ANGLE => self::ANGLE_GROUPS,
        self::AXLE_TILT_ANGLE  => self::ANGLE_GROUPS,
    );

    public const TAX_GROUPS = array(
        'angle' => self::ROTATION_ANGLES,
    );

    // Rotation Functions
    public const STUD_TILT  = 'stud_tilt';
    public const STUD_TWIST = 'stud_twist';
    public const AXLE_TILT  = 'axle_tilt';
    public const ROTATIONS = array( 
        self::STUD_TILT, 
        self::STUD_TWIST, 
        self::AXLE_TILT,
    );

    // Rotation Taxonomies
    public const STUD_TILT_ANGLE  = self::STUD_TILT . '_angle';
    public const STUD_TWIST_ANGLE = self::STUD_TWIST . '_angle';
    public const AXLE_TILT_ANGLE  = self::AXLE_TILT . '_angle';
    public const ROTATION_ANGLES = array(
        self::STUD_TILT_ANGLE, 
        self::STUD_TWIST_ANGLE,  
        self::AXLE_TILT_ANGLE, 
    );

    // Automatically generated rotation ranges
    public const ANGLE_GROUPS = array( 
        array( 0, 45, '0-45'),
        array( 45, 90, '45-90'),
        array( 90, 180, '90-180'),
    );
    
    // public const FUNCTION_OBJECT   = 'object';
    // public const FUNCTION_OFFSET   = 'offset';
    // public const FUNCTION_PATTERN  = 'pattern';
    // public const FUNCTION_ROTATION = 'rotation';
    // public const FUNCTION_SHAPE    = 'shape';

    // public static function get_rotation_choices() {
    //     return array(
    //         self::ROTATION_STUD_TILT  => __('Stud Tilt', 'brickcamp'),
    //         self::ROTATION_STUD_TWIST => __('Stud Twist', 'brickcamp'),
    //         self::ROTATION_AXLE_TILT  => __('Axle Tilt', 'brickcamp'),
    //     );
    // }

    // public const OFFSET_STUD_SHIFT = 'stud_shift';
    // public const OFFSET_STUD_LIFT = 'stud_lift';
    // public const OFFSET_AXLE_SHIFT = 'axle_shift';

    // public const PATTERN_1D = '1D';
    // public const PATTERN_2D = '2D';
    // public const PATTERN_3D = '3D';

    // public const SHAPE_2D = '2D';
    // public const SHAPE_3D = '3D';

    // public const ORDER_ASC = 'ASC';
    // public const ORDER_DESC = 'DESC';

    // public const ORDER_BY_AUTHOR = 'author';
    // public const ORDER_BY_TITLE = 'title';
    // public const ORDER_BY_DATE = 'date';
    // public const ORDER_BY_MODIFIED = 'modified';
    // public const ORDER_BY_RANDOM = 'rand';
    // public const ORDER_BY_COMMENTS = 'comment_count';
    // public const ORDER_BY_PART_COUNT = Names::PART_COUNT;
}