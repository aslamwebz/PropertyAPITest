<?php

namespace Config;

/**
 * View
 *
 * PHP version 7.0
 */
class View
{

    /**
     * Render a view file
     *
     * @param string $view  The view file
     * @param array  $data   data to display in the view (optional)
     * @param string $msg    message to display in the view (optional)
     * @param string $error  error to display in the view (optional)
     *
     * @return void
     */
    public static function render($view, $data = [], $msg = '', $error = '')
    {

        $file = dirname(__DIR__)  . '/src/views/' . $view;

        if (is_readable($file . '.php')) {
            require $file . '.php';
        } else {
            throw new \Exception("$file not found");
        }
    }
}
