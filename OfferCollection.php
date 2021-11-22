<?php

namespace myApp;


class OfferCollection implements OfferCollectionInterface
{

    private array $array = [];

    public function __construct(array $array)
    {
        $this->array = $array;
    }


    public function get(int $index): OfferInterface|null
    {
        return $this->array[$index] ?? null;
    }

    public function getIterator(): \Iterator
    {
        return new \myApp\MyIterator($this->array);
    }
}