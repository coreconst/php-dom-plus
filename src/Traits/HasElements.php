<?php

namespace PhpDomPlus\Traits;

use DOMXPath;
use PhpDomPlus\Dom\NodeList;
use ReturnTypeWillChange;

trait HasElements
{
    public function getElementsByClassName(string $classname): NodeList
    {
        $xpath = new DOMXPath($this);
        return new NodeList($xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]"));
    }

    #[ReturnTypeWillChange] public function getElementsByTagName(string $qualifiedName)
    {
        return new NodeList(parent::getElementsByTagName($qualifiedName));
    }

    #[ReturnTypeWillChange] public function getElementsByTagNameNS(string|null $namespace, string $localName)
    {
        return new NodeList(parent::getElementsByTagNameNS($namespace, $localName));
    }
}