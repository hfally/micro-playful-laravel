<?php
include('helpers.php');

$env_file = base_dir('.env');

if ( file_exists ( $env_file ) ) {
    $contents = file_get_contents( $env_file );
    $variables = explode( PHP_EOL, $contents );
    $variables = array_diff($variables, [""]);

    foreach ( $variables as $variable) {
        putenv( $variable );
    }
}