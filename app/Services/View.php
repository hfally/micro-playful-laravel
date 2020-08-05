<?php

namespace App\Services;

/**
 * Class View.
 */
class View
{
    /**
     * @var string Page to view.
     */
    private string $page;

    /**
     * View constructor.
     *
     * @param string $page
     */
    public function __construct(string $page)
    {
        $this->page = $page;
    }

    /**
     * Make a view.
     *
     * @return string
     */
    public function make(): string
    {
        $page = str_replace('.', '/', $this->page);
        $page = trim($page, '/');
        $view = base_dir("views/{$page}.fally.php");

        return "require '$view';";
    }
}