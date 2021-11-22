<?php

namespace myApp;

class Offer implements OfferInterface, \JsonSerializable
{

    private int $offerId = 0;
    private int $vendorId = 0;
    private float $price = 0;
    private string $productTitle = "";

    public function __construct($offerId, $productTitle, $vendorId, $price)
    {
        $this->offerId = $offerId;
        $this->productTitle = $productTitle;
        $this->vendorId = $vendorId;
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getOfferId(): int
    {
        return $this->offerId;
    }

    /**
     * @param int $offerId
     */
    public function setOfferId(int $offerId): void
    {
        $this->offerId = $offerId;
    }

    /**
     * @return int
     */
    public function getVendorId(): int
    {
        return $this->vendorId;
    }

    /**
     * @param int $vendorId
     */
    public function setVendorId(int $vendorId): void
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @return float|int
     */
    public function getPrice(): float|int
    {
        return $this->price;
    }

    /**
     * @param float|int $price
     */
    public function setPrice(float|int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getProductTitle(): string
    {
        return $this->productTitle;
    }

    /**
     * @param string $productTitle
     */
    public function setProductTitle(string $productTitle): void
    {
        $this->productTitle = $productTitle;
    }


    public function jsonSerialize()
    {
        return [
            "offerId" => $this->getOfferId(),
            "productTitle" => $this->getProductTitle(),
            "vendorId" => $this->getVendorId(),
            "price" => $this->getPrice(),
        ];
    }
}