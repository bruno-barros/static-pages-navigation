<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 21/04/14
 * Time: 11:37
 */

namespace Newsnav;

class Template
{
    protected $app;
    /**
     * @var
     */
    protected $viewPath;

    /**
     * @var
     */
    protected $vars;

    /**
     *
     */
    function __construct(App $app)
    {
        $this->app = $app;
        $this->viewPath = $this->app->getPath('views');

    }

    /**
     * Set a template variable.
     */
    function set($name, $value) {
        $this->vars[$name] = $value;
    }

    /**
     * @param string $view
     * @return string
     */
    public function view($view = 'master')
    {
        $file = $this->generatePathToFile($view);

        // Extract the vars to local namespace
        extract($this->vars);
        ob_start();
        include($this->viewPath . '/' .$file);
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;

//        return file_get_contents($this->viewPath . '/' .$file);
    }

    /**
     * @param $string
     * @return mixed|string
     */
    public function generatePathToFile($string)
    {
        $file = str_replace('.', '/', $string);
        $file = trim($file, '/');
        $file = $file . '.php';

        return $file;
    }
}