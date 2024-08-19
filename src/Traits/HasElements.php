<?php

namespace PhpDomPlus\Traits;

use DOMXPath;
use PhpDomPlus\Dom\NodeList;
use ReturnTypeWillChange;
use Symfony\Component\CssSelector\CssSelectorConverter;

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

    public function querySelector(string $selector): ?\DOMNode
    {
        $xpath = new DOMXPath($this);
        $xpathQuery = $this->convertCssSelectorToXPath($selector);
        $result = $xpath->query($xpathQuery);

        return $result->length > 0 ? $result->item(0) : null;
    }

    public function querySelectorAll(string $selector): ?NodeList
    {
        $xpath = new DOMXPath($this);
        $xpathQuery = $this->convertCssSelectorToXPath($selector);
        return new NodeList($xpath->query($xpathQuery));
    }

    private function convertCssSelectorToXPath(string $selector): string
    {
        $converter = new CssSelectorConverter();
        return $converter->toXPath($selector);
    }
}