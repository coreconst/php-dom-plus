<?php

namespace PhpDomPlus;

class Element extends \DOMElement
{
    public function __get($name): ?string
    {
        return match ($name) {
            'innerHTML' => $this->getInnerHTML(),
            'outerHTML' => $this->getOuterHTML(),
            default => null
        };
    }

    private function getInnerHTML(): string
    {
        $innerHTML = '';
        foreach ($this->childNodes as $child) {
            $innerHTML .= $this->ownerDocument->saveHTML($child);
        }
        return $innerHTML;
    }

    private function getOuterHTML(): string
    {
        return $this->ownerDocument->saveHTML($this);
    }

}