<?php

// Toggle error reporting
if (env('APP_DEBUG')) {
    ini_set('display_errors', true);
    error_reporting(E_ALL | ~E_NOTICE);
}

// MERGE REQUEST BAGS
$_REQUEST = array_merge($_REQUEST, $_FILES);

