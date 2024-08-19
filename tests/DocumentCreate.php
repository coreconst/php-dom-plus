<?php

namespace PhpDomPlus\Tests;

use PhpDomPlus\Document;

trait DocumentCreate
{
    /** @var Document */
    protected $document;

    protected $testElement;

    protected function setUp(): void
    {
        $this->document = new Document();
        $this->document->loadHTML('<html><body><div id="test" class="example">content1</div><div class="example">content2</div></body></html>');
        $this->testElement = $this->document->getElementById('test');
    }
}