<?php
/**
 * Bootstrap the application.
 */

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
$uri = trim($_SERVER['REQUEST_URI'], '/');
$query_strings = $_SERVER['QUERY_STRING'];

if (!route_exists($request_method, $uri)) {
    $view_command = page_not_found()->make();

    eval($view_command);
    exit;
}

// Process the route visited.
try {
    $response = route_process(route_controller_string($request_method, $uri));

    // Execute the view command if it is a View instance.
    if ($response instanceof \App\Services\View) {
        eval($response->make());
        exit;
    }

    // If response is a string, echo it.
    if (is_string($response)) {
        echo $response;
    }

    return $response;
} catch (\Exception $e) {
    if ($e instanceof \App\Exceptions\ValidatorException) {
        $GLOBALS['errors'] = $e->errors();
    }
}
