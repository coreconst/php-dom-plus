<?php

namespace PhpDomPlus;

use PhpDomPlus\Traits\HasElements;

class Document extends \DOMDocument
{
    use HasElements;

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

}