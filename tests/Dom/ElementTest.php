<?php

namespace PhpDomPlus\Tests\Dom;

use PhpDomPlus\Tests\DocumentCreate;
use PHPUnit\Framework\TestCase;

class ElementTest extends TestCase
{
    use DocumentCreate;

    public function testElementGetInnerAndOuterHtml(): void
    {
        $this->assertEquals('content1', $this->testElement->innerHTML);
        $this->assertEquals('<div id="test" class="example">content1</div>',  $this->testElement->outerHTML);
    }

    public function testElementClassListAddClass(): void
    {
        $this->testElement->classList->add('add1', 'add2');
        $this->assertEquals('example add1 add2', $this->testElement->className);
    }

    public function testElementClassListRemoveClass(): void
    {
        $this->testElement->classList->remove('example');
        $this->assertEmpty($this->testElement->className);
    }

    public function testElementClassListToggleClass(): void
    {
        $this->testElement->classList->toggle('add');
        $this->assertEquals('example add', $this->testElement->className);

        $this->testElement->classList->toggle('add');
        $this->assertEquals('example', $this->testElement->className);
    }

    public function testElementClassListContainsAndToArray(): void
    {
        $exampleClassExists = $this->testElement->classList->contains('example');
        $this->assertTrue($exampleClassExists);

        $this->testElement->classList->add('add');
        $this->assertEquals(['example', 'add'], $this->testElement->classList->toArray());
    }

}