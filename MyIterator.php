<?php

namespace myApp;

class MyIterator implements \Iterator
{

    private int $position;
    private array $array;

    public function __construct(array $array)
    {
        $this->array = $array;
        $this->position = 0;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current(): OfferInterface
    {
        return $this->array[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        return isset($this->array[$this->position]);
    }
}