<?php
namespace Grav\Plugin\BrickCamp;

abstract class Flags {

    public const TAXONOMY = 'flag';

    public const FIELDS = array(
        'title' => array(
            self::MISSING,
            self::TOO_LONG => 20,
        ),
        'source.url' => array(
            self::MISSING,
        ),
        'source.title' => array(
            self::DEPENDS_ON => 'source.url',
            self::MISSING,
        ),
    );

    public const MISSING = 'missing';
    public const NOFILE = 'nofile';
    public const INVALID = 'invalid';
    public const TOO_LONG = 'too_long';
    public const DEPENDS_ON = 'dependance';


    public const PREFIX_MISSING_FIELD = '_missing_';
    public const CHECK_FIELDS = array(
        'title',
        'date',
        'image',
        'cad',
        'source' => array(
            'url',
            'title',
            'author',
            'date',
        ),
    );
}