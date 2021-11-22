<?php

namespace myApp;

class Reader implements ReaderInterface
{

    /**
     * @inheritDoc
     */
    public function read(string $input): OfferCollectionInterface
    {
        $returnCollection = [];
        $data = json_decode($input);
        if (!$data) {
            echo json_encode(["error" => "couldn't decode offers!"]);

            if (isset($_SERVER["REQUEST_METHOD"])) {
                $file = fopen('./logs/' . date('Y-m-d'), "a");
                fwrite($file, "Request Failed: couldn't decode offers! api response was: \n $input \n\n-----------------\n\n");
                fclose($file);
            } else {
                $file = fopen('./logs/' . date('Y-m-d') . "-CLI", "a");
                fwrite($file, "CLI call Failed: couldn't decode offers! api response was: \n $input \n\n-----------------\n\n");
                fclose($file);
            }

            die();
        }

        foreach ($data as $offer) {
            $returnCollection[] = new Offer($offer->offerId, $offer->productTitle, $offer->vendorId, $offer->price);
        }

        return new OfferCollection($returnCollection);
    }
}