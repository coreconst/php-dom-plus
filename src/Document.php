<?php

namespace PhpDomPlus;

use PhpDomPlus\Service\HttpClient;
use PhpDomPlus\Traits\HasElements;

class Document extends \DOMDocument
{
    use HasElements;

    protected ?string $url = null;

    public function __construct() {
        parent::__construct();

        $this->registerNodeClass('DOMDocument', 'PhpDomPlus\Document');
        $this->registerNodeClass('DOMElement', 'PhpDomPlus\Element');

    }

    public function loadHTMLByUrl($url): void
    {
        $client = new HttpClient();
        $page = $client->getPage('http://example.com');
        $this->loadHTML($page);
    }

}