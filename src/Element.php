<?php

namespace PhpDomPlus;

use PhpDomPlus\Support\ClassList;

class Element extends \DOMElement
{
    private ?ClassList $classList = null;

    public function __get($name): mixed
    {
        return match ($name) {
            'innerHTML' => $this->getInnerHTML(),
            'outerHTML' => $this->getOuterHTML(),
            'classList' => $this->getClassList(),
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

    private function getClassList(): ClassList
    {
        if ($this->classList === null) {
            $this->classList = new ClassList($this);
        }
        return $this->classList;
    }
}