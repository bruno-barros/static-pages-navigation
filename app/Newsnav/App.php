<?php
/**
 * Main app class
 */

namespace Newsnav;

use Newsnav\UrlParser;
use Newsnav\Template;
use Newsnav\Page;

class App
{

    /**
     * @var array
     */
    protected $configs = array();

    /**
     * @var array
     */
    protected $paths = array();

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $pages = array();

    function __construct()
    {
    }


    /**
     * register paths
     * @param array $paths
     */
    public function bindPaths(array $paths)
    {
        foreach ($paths as $abstract => $path)
        {
            $this->paths[$abstract] = $path;
        }
    }

    /**
     * @param array $configs
     */
    public function loadConfiguration(array $configs)
    {
        foreach ($configs as $key => $value)
        {
            $this->configs[$key] = $value;
        }
    }

    /**
     * lazy load to pass the paths to classes
     */
    public function loadDependencies()
    {

        $this->request  = new UrlParser($this);
        $this->template = new Template($this);
    }

    /**
     * include helpers files
     */
    public function loadHelpers()
    {
        $helpersPath = $this->getPath('helpers');

        foreach (new \DirectoryIterator($helpersPath) as $file)
        {
            if ($file->isDot() or $file->isDir())
            {
                continue;
            }

            require $file->getPathname();
        }
    }

    /**
     * return the path
     *
     * @param $abstract
     * @return mixed
     */
    public function getPath($abstract)
    {
        if (array_key_exists($abstract, $this->paths))
        {
            return $this->paths[$abstract];
        }

        return null;
    }


    /**
     * return the configuration
     *
     * @param $key
     * @return mixed
     */
    public function getConfig($key = null)
    {
        if($key === null)
        {
            return $this->configs;
        }

        if (array_key_exists($key, $this->configs))
        {
            return $this->configs[$key];
        }

        return null;
    }

    public function run()
    {

        // load current url
        //        var_dump();
//        $this->template->set('path', $this->request->pathInfo());

        //        var_dump($this->pages);
        //        die;

        $this->template->set('config', $this->getConfig());
        $this->template->set('pages', $this->getPages());
        $this->template->set('page', $this->request->activePage());

        // load template
        $html = $this->template->view('master');

        // echo out
        echo $html;
    }

    /**
     * load directories that represents pages
     * return Page instance
     * increments the $this->pages attribute
     *
     * @return void
     */
    public function loadPages()
    {
        $pagesPath = $this->getPath('pages');

        foreach (new \DirectoryIterator($pagesPath) as $file)
        {
            if ($file->isDir() && !$file->isDot())
            {
                $this->pages[] = new Page($this, $file->getPathname());
            }
        }

    }

    /**
     * @return array
     */
    public function getPages()
    {
        return $this->pages;
    }
}