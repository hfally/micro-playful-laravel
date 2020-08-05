<?php
if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        if (($valueLength = strlen($value)) > 1 && $value[0] === '"' && $value[$valueLength - 1] === '"') {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (!function_exists('base_dir')) {
    /**
     * Returns path relative to basedir
     *
     * @param string|null $path
     *
     * @return string
     */
    function base_dir(string $path = null): string
    {
        return __DIR__ . '/' . $path;
    }
}

if (!function_exists('route_get')) {
    /**
     * Register a get route.
     *
     * @param string $uri
     * @param string $controllerString
     *
     * @return string
     */
    function route_get(string $uri, string $controllerString)
    {
        return $GLOBALS['APP_ROUTER']['GET'][$uri] = $controllerString;
    }
}

if (!function_exists('route_post')) {
    /**
     * Register a post route.
     *
     * @param string $uri
     * @param string $controllerString
     *
     * @return string
     */
    function route_post(string $uri, string $controllerString)
    {
        return $GLOBALS['APP_ROUTER']['POST'][$uri] = $controllerString;
    }
}

if (!function_exists('route_exists')) {
    /**
     * Check that route provided exists.
     *
     * @param string $method
     * @param        $uri
     *
     * @return bool
     */
    function route_exists(string $method, $uri): bool
    {
        return isset($GLOBALS['APP_ROUTER'][$method][$uri]);
    }
}

if (!function_exists('route_controller_string')) {
    /**
     * Get controller string.
     *
     * @param string $method
     * @param string $uri
     *
     * @return string
     */
    function route_controller_string(string $method, string $uri): string
    {
        $uri = trim($uri, '/');

        return $GLOBALS['APP_ROUTER'][$method][$uri];
    }
}

if (!function_exists('route_process')) {
    /**
     * Process controller string.
     *
     * @param string $controller_string
     *
     * @return mixed
     */
    function route_process(string $controller_string)
    {
        $strings = explode('@', $controller_string);
        $controller = 'App\Controllers\\' . $strings[0];
        $method = $strings[1];

        return (new $controller)->{$method}();
    }
}

if (!function_exists('page_not_found')) {
    /**
     * Abort with error page.
     *
     * @return \App\Services\View
     */
    function page_not_found()
    {
        return view('errors/404');
    }
}

if (!function_exists('view')) {
    /**
     * Return a view.
     *
     * @param string $page
     *
     * @return \App\Services\View
     */
    function view(string $page): \App\Services\View
    {
        return new \App\Services\View($page);
    }
}

if (!function_exists('asset')) {
    /**
     * Return asset url.
     *
     * @param string $asset
     *
     * @return string
     */
    function asset(string $asset): string
    {
        return env('APP_URL') . '/' . trim($asset, '/');
    }
}

if (!function_exists('storage_path')) {
    /**
     * Return file path relative to storage path.
     *
     * @param string|null $file_path
     *
     * @return string
     */
    function storage_path(?string $file_path = null): string
    {
        return base_dir('storage') . '/' . trim($file_path, '/');
    }
}

if (!function_exists('json_response')) {
    /**
     * Return JSON response.
     *
     * @param     $data
     * @param int $code
     *
     * @return false|string
     */
    function json_response($data, int $code = 200)
    {
        header('Content-Type: application/json');
        http_response_code($code);

        return json_encode($data);
    }
}

if (!function_exists('dd')) {
    /**
     * Dump and die.
     *
     * @param mixed ...$var
     *
     * @return void
     */
    function dd(...$var)
    {
        foreach ($var as $item) {
            dump($item);
        }

        die();
    }
}
