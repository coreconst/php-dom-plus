<?php

namespace PhpDomPlus;

use DOMXPath;

class Document extends \DOMDocument
{
    protected ?string $url = null;

    public function __construct() {
        parent::__construct();

    }

    public function loadHTMLByUrl($url): void
    {
        $client = new HttpClient();
        $page = $client->getPage('http://example.com');
        $this->loadHTML($page);
    }

    public function getElementsByClassName(string $classname): \DOMNodeList
    {
        $xpath = new DOMXPath($this);
        return $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
    }

}