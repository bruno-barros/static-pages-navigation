<?php
namespace Newsnav;

use Symfony\Component\HttpFoundation\Request;

class UrlParser
{

    protected $app;

    protected $request;

    function __construct($app)
    {
        $this->app     = $app;
        $this->request = Request::createFromGlobals();
    }

    public function pathInfo()
    {
        return $this->request->getPathInfo();
    }

    public function segments()
    {
        return $this->request->query->all();
    }

    /**
     * @return null|string
     */
    public function getActivePageFolder()
    {
        // try by url
        $uri = $this->pathInfo();
        if ($uri === '/')
        {
            return null;
        }

        $segments = explode('/', trim($uri, '/'));

        return $segments[0];

    }

    /**
     * if not on url, get the first
     */
    public function activePage()
    {

        $pages        = $this->app->getPages();
        $activeFolder = $this->getActivePageFolder();

        // get the first page
        if ($activeFolder === null)
        {
            return $pages[0];
        }

        foreach ($pages as $p)
        {
            if ($p->folder === $activeFolder)
            {
                return $p;
            }
        }

        return null;

    }
}