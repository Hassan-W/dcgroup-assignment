<?php

namespace myApp;
/**
 * Interface for The Collection class that contains Offers
 */
interface OfferCollectionInterface
{
    public function get(int $index): OfferInterface|null;

    public function getIterator(): \Iterator;
}