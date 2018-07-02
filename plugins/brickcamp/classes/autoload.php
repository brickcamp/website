<?php

/**
 * Define automatic loading of class files
 */
spl_autoload_register( function( $class ) {
    $prefix = 'Grav\\Plugin\\BrickCamp\\';
    $base_dir = __DIR__ . DIRECTORY_SEPARATOR;

    // does the class use the namespace prefix?
    $len = strlen( $prefix );
    if( strncmp( $prefix, $class, $len ) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr( $class, $len );

	// derive file and path from class name
	$relative_class = str_replace( '\\', DIRECTORY_SEPARATOR, $relative_class );
    $file = $base_dir . $relative_class . '.php';

    // if the file exists, require it
    if( file_exists( $file ) ) {
        require_once $file;
    }
});