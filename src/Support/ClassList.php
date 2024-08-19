<?php

namespace PhpDomPlus\Support;

class ClassList
{
    private \DOMElement $element;

    public function __construct(\DOMElement $element)
    {
        $this->element = $element;
    }

    public function add(string ...$classes): void
    {
        foreach ($classes as $class) {
            if (!$this->contains($class)) {
                $this->element->setAttribute('class', trim($this->element->getAttribute('class') . ' ' . $class));
            }
        }
    }

    public function remove(string ...$classes): void
    {
        $currentClasses = explode(' ', $this->element->getAttribute('class'));
        $updatedClasses = array_diff($currentClasses, $classes);
        $this->element->setAttribute('class', implode(' ', $updatedClasses));
    }

    public function contains(string $class): bool
    {
        $currentClasses = explode(' ', $this->element->getAttribute('class'));
        return in_array($class, $currentClasses);
    }

    public function toggle(string $class): void
    {
        if ($this->contains($class)) {
            $this->remove($class);
        } else {
            $this->add($class);
        }
    }

    public function toArray(): array
    {
        return explode(' ', $this->element->getAttribute('class'));
    }
}