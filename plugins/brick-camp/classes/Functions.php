<?php
namespace Grav\Plugin\BrickCamp;

abstract class Functions {

    public const TAXONOMY = 'function';

    // Taxonomies related to function terms 
    public const TAXONOMIES = array(
        // self::ROTATIONS
        self::STUD_TILT  => self::STUD_TILT_ANGLE,
        self::STUD_TWIST => self::STUD_TWIST_ANGLE,
        self::AXLE_TILT  => self::AXLE_TILT_ANGLE,
        
        // self::OFFSETS
        self::STUD_SHIFT => self::STUD_SHIFT_LENGTH,
        self::STUD_LIFT  => self::STUD_LIFT_LENGTH,
        self::AXLE_SHIFT => self::AXLE_SHIFT_LENGTH,

        // self::SHAPES
        self::SHAPE_2D   => array(
            self::SHAPE_2D_SEGMENTS,
            self::SHAPE_2D_SEGSIZE,
        ),
        self::SHAPE_3D   => array(
            self::SHAPE_3D_SEGMENTS,
            self::SHAPE_3D_SEGSIZE,
        ),

        // self::PATTERN
        self::PATTERN_1D => self::PATTERN_1D_SEGSIZE,
        self::PATTERN_2D => self::PATTERN_2D_SEGSIZE,
        self::PATTERN_3D => self::PATTERN_3D_SEGSIZE,

        // self::MODULE
        self::MODULE => self::MODULE_TYPE,
    );

    // Auto-generated terms
    public const TERM_GROUPS = array(
        // self::ANGLE_GROUPS
        self::STUD_TILT_ANGLE   => self::ANGLE_GROUPS,
        self::STUD_TWIST_ANGLE  => self::ANGLE_GROUPS,
        self::AXLE_TILT_ANGLE   => self::ANGLE_GROUPS,

        // self::SEGMENT_GROUPS
        self::SHAPE_2D_SEGMENTS => self::SEGMENT_GROUPS,
        self::SHAPE_3D_SEGMENTS => self::SEGMENT_GROUPS,

        // self::SEGSIZE_GROUPS
        self::SHAPE_2D_SEGSIZE  => self::SEGSIZE_GROUPS,
        self::SHAPE_3D_SEGSIZE  => self::SEGSIZE_GROUPS,
        self::PATTERN_1D_SEGSIZE  => self::SEGSIZE_GROUPS,
        self::PATTERN_2D_SEGSIZE  => self::SEGSIZE_GROUPS,
        self::PATTERN_3D_SEGSIZE  => self::SEGSIZE_GROUPS,
    );

    // prefix for auto-generated terms/taxonomies
    public const TERM_GROUP_PREFIX = '_';    

    // Auto-generated taxonomies
    public const TAX_GROUPS = array(
        'rotation_angle' => self::ROTATION_ANGLES,
        'offset_length'  => self::OFFSET_LENGTHS,
        'shape_segments' => self::SHAPE_SEGMENTS,
        'shape_segsize'  => self::SHAPE_SEGSIZE,
        'pattern_segsize' => self::PATTERN_SEGSIZE,
    );


    /* * * * * * * * * * * * * * * * * * * * * * * * *
     *   ROTATIONS
     * * * * * * * * * * * * * * * * * * * * * * * * */ 
    // Functions
    public const STUD_TILT  = 'stud_tilt';
    public const STUD_TWIST = 'stud_twist';
    public const AXLE_TILT  = 'axle_tilt';
    public const ROTATIONS = array( 
        self::STUD_TILT, 
        self::STUD_TWIST, 
        self::AXLE_TILT,
    );

    // Taxonomies
    public const STUD_TILT_ANGLE  = self::STUD_TILT . '_angle';
    public const STUD_TWIST_ANGLE = self::STUD_TWIST . '_angle';
    public const AXLE_TILT_ANGLE  = self::AXLE_TILT . '_angle';
    public const ROTATION_ANGLES = array(
        self::STUD_TILT_ANGLE, 
        self::STUD_TWIST_ANGLE,  
        self::AXLE_TILT_ANGLE, 
    );

    // Auto-Terms
    public const ANGLE_GROUPS = array( 
        array( 0, 45, '0-45'),
        array( 45, 90, '45-90'),
        array( 90, 180, '90-180'),
    );

    
    /* * * * * * * * * * * * * * * * * * * * * * * * *
     *   OFFSETS
     * * * * * * * * * * * * * * * * * * * * * * * * */
    // Functions
    public const STUD_LIFT  = 'stud_lift';
    public const STUD_SHIFT = 'stud_shift';
    public const AXLE_SHIFT = 'axle_shift';
    public const OFFSETS = array( 
        self::STUD_LIFT, 
        self::STUD_SHIFT, 
        self::AXLE_SHIFT,
    );

    // Taxonomies
    public const STUD_LIFT_LENGTH  = self::STUD_LIFT . '_length';
    public const STUD_SHIFT_LENGTH = self::STUD_SHIFT . '_length';
    public const AXLE_SHIFT_LENGTH = self::AXLE_SHIFT . '_length';
    public const OFFSET_LENGTHS = array(
        self::STUD_LIFT_LENGTH, 
        self::STUD_SHIFT_LENGTH,  
        self::AXLE_SHIFT_LENGTH, 
    );

    /* * * * * * * * * * * * * * * * * * * * * * * * *
     *   SHAPES
     * * * * * * * * * * * * * * * * * * * * * * * * */
    // Functions
    public const SHAPE_2D = 'shape_2D';
    public const SHAPE_3D = 'shape_3D';
    public const SHAPES = array( 
        self::SHAPE_2D, 
        self::SHAPE_3D, 
    );

    // Taxonomies
    public const SHAPE_2D_SEGMENTS = self::SHAPE_2D . '_segments';
    public const SHAPE_3D_SEGMENTS = self::SHAPE_3D . '_segments';
    public const SHAPE_SEGMENTS = array(
        self::SHAPE_2D_SEGMENTS, 
        self::SHAPE_3D_SEGMENTS,
    );

    public const SHAPE_2D_SEGSIZE = self::SHAPE_2D . '_segsize';
    public const SHAPE_3D_SEGSIZE = self::SHAPE_3D . '_segsize';
    public const SHAPE_SEGSIZE = array(
        self::SHAPE_2D_SEGSIZE, 
        self::SHAPE_3D_SEGSIZE,
    );

    /* * * * * * * * * * * * * * * * * * * * * * * * *
     *   PATTERNS
     * * * * * * * * * * * * * * * * * * * * * * * * */
    // Functions
    public const PATTERN_1D  = 'pattern_1D';
    public const PATTERN_2D  = 'pattern_2D';
    public const PATTERN_3D  = 'pattern_3D';
    public const PATTERNS = array( 
        self::PATTERN_1D, 
        self::PATTERN_2D, 
        self::PATTERN_3D,
    );

    // Taxonomies
    public const PATTERN_1D_SEGSIZE = self::PATTERN_1D . '_segsize';
    public const PATTERN_2D_SEGSIZE = self::PATTERN_2D . '_segsize';
    public const PATTERN_3D_SEGSIZE = self::PATTERN_3D . '_segsize';
    public const PATTERN_SEGSIZE = array(
        self::PATTERN_1D_SEGSIZE, 
        self::PATTERN_2D_SEGSIZE,
        self::PATTERN_3D_SEGSIZE,
    );

    // Auto-Terms
    public const SEGMENT_GROUPS = array( 
        array( 9, PHP_INT_MAX, '9up'),
    );

    public const SEGSIZE_GROUPS = array( 
        array( 9, PHP_INT_MAX, '9up'),
    );
    
    /* * * * * * * * * * * * * * * * * * * * * * * * *
     *   OFFSETS
     * * * * * * * * * * * * * * * * * * * * * * * * */
    // Functions
    public const MODULE  = 'module';

    // Taxonomies
    public const MODULE_TYPE  = self::MODULE . '_type';
}