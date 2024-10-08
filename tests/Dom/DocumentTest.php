<?php

namespace PhpDomPlus\Tests\Dom;

use PhpDomPlus\Tests\DocumentCreate;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
    use DocumentCreate;

    public function testGetElementsByClassNameReturnsElement(): void
    {
        $element = $this->document->getElementsByClassName('example')->item(0);

        $this->assertInstanceOf(\DOMNode::class, $element);
        $this->assertEquals('test', $element->getAttribute('id'));
    }

    public function testGetElementsByClassNameReturnsNullForNoMatch(): void
    {
        $element = $this->document->getElementsByClassName('non-existent')->item(0);
        $this->assertNull($element);
    }

    public function testGetTextContentOfElements(): void
    {
        $elements = $this->document->getElementsByClassName('example');
        $this->assertEquals(['content1', 'content2'], $elements->textContents());
    }

    public function testQuerySelectorAndQuerySelectorAllReturnsElement(): void
    {
        $div = $this->document->querySelector('#test');
        $elements = $this->document->querySelectorAll('.example');

        $this->assertEquals('content1', $div->nodeValue);
        $this->assertEquals(['content1', 'content2'], $elements->textContents());
    }

}