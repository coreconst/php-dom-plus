<?php

namespace PhpDomPlus\Dom;

use Iterator;

class NodeList
{
    private \DOMNodeList $domNodeList;

    public function __construct(\DOMNodeList $domNodeList)
    {
        $this->domNodeList = $domNodeList;
    }

    public function length(): int { return $this->domNodeList->length; }

    public function count(): int { return $this->domNodeList->count(); }

    public function getIterator(): Iterator { return $this->domNodeList->getIterator(); }

    public function item(int $index): ?\DOMNode { return $this->domNodeList->item($index); }

    /**
     * Returns an array of the text contents of each element
     *
     * @return array
     */
    public function textContents(): array
    {
        $contentArray = [];

        foreach ($this->domNodeList as $node) {
            if ($node instanceof \DOMElement) {
                $contentArray[] = trim($node->textContent);
            }
        }

        return $contentArray;
    }

    public function first(): ?\DOMNode
    {
        return $this->item(0);
    }

    public function last(): ?\DOMNode
    {
        return $this->item($this->length() - 1);
    }

}