<?php

namespace myApp;
include 'all.php';

header('Content-type: application/json');

$file = fopen('./logs/' . date('Y-m-d'), "a");
fwrite($file,
    "A " . $_SERVER["REQUEST_METHOD"] . " request to '" . $_SERVER['REQUEST_URI'] . "' at port " . $_SERVER["SERVER_PORT"] . " was received at: " . date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']) . "\n" .
    "User-agent: " . $_SERVER['HTTP_USER_AGENT'] . "\n" .
    "User-IP: " . $_SERVER['REMOTE_ADDR'] . "\n"
);
fclose($file);

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(["error" => "unsupported request method"]);
    $file = fopen('./logs/' . date('Y-m-d'), "a");
    fwrite($file, "Request Failed: unsupported request method\n\n-----------------\n\n");
    fclose($file);
    die();

}
if (!isset($_POST["offer_filter"]) || !isset($_POST["offer_filter_type"])) {
    echo json_encode(["error" => "missing required parameter"]);
    $file = fopen('./logs/' . date('Y-m-d'), "a");
    fwrite($file, "Request Failed: missing required parameter\n\n-----------------\n\n");
    fclose($file);
    die();
}

$reader = new Reader();
$offers = $reader->read('[
                     {
                     "offerId": 123,
                     "productTitle": "Coffee machine",
                     "vendorId": 35,
                     "price": 390.4
                     },
                     {
                     "offerId": 124,
                     "productTitle": "Napkins",
                     "vendorId": 35,
                     "price": 15.5
                     },
                     {
                     "offerId": 125,
                     "productTitle": "Chair",
                     "vendorId": 84,
                     "price": 230.0
                     }
                  ]');

$filter = $_POST["offer_filter"];
$val = explode(' ', $_POST["offer_filter_type"]);
$filter_val = $val[0];
$filter_val_range = $val[1] ?? null;

$count = filter($offers, $filter, $filter_val, $filter_val_range);

$file = fopen('./logs/' . date('Y-m-d'), "a");
fwrite($file, "Request Success: count of offers: $count\n\n-----------------\n\n");
fclose($file);

echo json_encode(["success" => ["count" => $count]]);
