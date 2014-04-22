<?php
/**
 *
 * Each directory is a page
 */

namespace Newsnav;

use Sunra\PhpSimple\HtmlDomParser;
use Newsnav\UrlParser;

class Page
{
    /**
     * @var int
     */
    static public $count = 0;
    /**
     * is the page is open
     * @var bool
     */
    public $isActive = false;
    /**
     * @var string
     */
    public $title = '';
    /**
     * @var string
     */
    public $htmlTitle = '';
    /**
     * @var string
     */
    public $folder = '';
    /**
     * @var int
     */
    protected $order = 0;
    /**
     * @var string
     */
    protected $dir = '';
    /**
     * @var
     */
    protected $dom;

    function __construct($dir)
    {
        $this->dir = $dir;
        $this->parse();
    }

    /**
     * parse the index.html
     * and set the attributes
     */
    public function parse()
    {
        self::$count++;

        $this->order = self::$count;

        $this->dom = HtmlDomParser::file_get_html($this->dir . '/index.html');

        $title = $this->dom->find('title');

        $this->setTitle($title[0]->plaintext);

        $this->setFolder();

        $urlParser = new UrlParser(null);
        $active = $urlParser->getActivePageFolder();

        $this->isActive = ($active === $this->getFolder()) ? true : false;



    }

    /**
     * @return string
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * @param string $folder
     */
    public function setFolder($folder = null)
    {
        if($folder === null)
        {
            $dir = str_replace('\\', '/', $this->dir);
            $ex = explode('/', $dir);
            $folder = $ex[count($ex)-1];
        }

        $this->folder = $folder;
    }

    /**
     * @return string
     */
    public function getHtmlTitle()
    {
        return $this->htmlTitle;
    }

    /**
     * @param string $htmlTitle
     */
    public function setHtmlTitle($htmlTitle)
    {
        // '|' == <br>
        $htmlTitle = str_replace('|', '<br>', $htmlTitle);
        $this->htmlTitle = $htmlTitle;
    }

    public function __toString(){
        $t = $this->dom->find('title');
        $t[0] = null;
        return (string)$this->dom;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->setHtmlTitle($title);
        $this->title = $title;
    }


}