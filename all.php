<?php

namespace myApp;

include 'MyIterator.php';
include 'ReaderInterface.php';
include 'OfferInterface.php';
include 'OfferCollectionInterface.php';
include 'OfferCollection.php';
include 'Reader.php';
include 'Offer.php';

interface Iterator
{
}

interface JsonSerializable
{
}

function filter(OfferCollectionInterface $collection, string $filter, $filter_val, $filter_val_range)
{
    $count = 0;
    $iter = $collection->getIterator();

    /**
     * @var OfferInterface $value
     */
    switch (strtolower($filter)) {
        case "count_by_offer_id":
        case "offer_id":
            foreach ($iter as $value) {
                $count = $value->getOfferId() == $filter_val ? ($count + 1) : $count;
            }
            break;
        case "count_by_product_title":
        case "product_title":
            foreach ($iter as $value) {
                $count = $value->getProductTitle() == $filter_val ? ($count + 1) : $count;
            }
            break;
        case "count_by_vendor_id":
        case "vendor_id":
            foreach ($iter as $value) {
                $count = $value->getVendorId() == $filter_val ? ($count + 1) : $count;
            }
            break;
        case "count_by_price":
        case "price":
            foreach ($iter as $value) {
                $count = $value->getPrice() == floatval($filter_val) ? ($count + 1) : $count;
            }
            break;
        case "count_by_price_range":
        case "price_range":
            foreach ($iter as $value) {
                $count = ($value->getPrice() > floatval($filter_val) && $value->getPrice() < floatval($filter_val_range)) ? ($count + 1) : $count;
            }
            break;
        default:
            echo json_encode(["error" => "filter type not found!!"]);
            if (isset($_SERVER["REQUEST_METHOD"])) {
                $file = fopen('./logs/' . date('Y-m-d'), "a");
                fwrite($file, "Request Failed: '$filter' filter type not found!! \n\n-----------------\n\n");
                fclose($file);
            } else {
                $file = fopen('./logs/' . date('Y-m-d') . "-CLI", "a");
                fwrite($file, "CLI call Failed: '$filter' filter type not found!! \n\n-----------------\n\n");
                fclose($file);
            }
            die();
    }
    return $count;
}