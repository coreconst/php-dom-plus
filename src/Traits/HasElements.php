<?php

namespace PhpDomPlus\Traits;

use DOMXPath;
use PhpDomPlus\Dom\NodeList;

trait HasElements
{
    public function getElementsByClassName(string $classname): NodeList
    {
        $xpath = new DOMXPath($this);
        return new NodeList($xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]"));
    }
}