<?php


namespace app\core;


abstract class Controller
{
    /**
     * Renders view inside layout
     *
     * @param string $layout - name of page layout
     * @param string $view - name of view file
     * @param array $data - data passed to view
     */
    public function render($layout, $view, $data = [])
    {
        ob_start();
        include __DIR__."../../views/$view.php";
        $content = ob_get_clean();
        include __DIR__."../../views/layouts/$layout.php";
    }
}