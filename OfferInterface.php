<?php

namespace myApp;

/**
 * Interface of Data Transfer Object, that represents external JSON data
 */
interface OfferInterface
{
    /**
     * @return int
     */
    public function getOfferId(): int;

    /**
     * @param int $offerId
     */
    public function setOfferId(int $offerId): void;

    /**
     * @return int
     */
    public function getVendorId(): int;

    /**
     * @param int $vendorId
     */
    public function setVendorId(int $vendorId): void;

    /**
     * @return float|int
     */
    public function getPrice(): float|int;

    /**
     * @param float|int $price
     */
    public function setPrice(float|int $price): void;

    /**
     * @return string
     */
    public function getProductTitle(): string;

    /**
     * @param string $productTitle
     */
    public function setProductTitle(string $productTitle): void;
}