<?php

namespace myApp;

$file = fopen('./logs/' . date('Y-m-d') . "-CLI", "a");
fwrite($file,
    "The '" . $_SERVER["COMPUTERNAME"] . "' computer initiated a CLI call from the '" . $_SERVER["USERNAME"] . "' username at: " . date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']) . "\n" .
    "the script params were: " . json_encode($_SERVER['argv']) . "\n"
);
fclose($file);


if ($argc < 3 || $argc > 4) {
    if ($argc == 2 && $argv[1] === "web") {
        exec("php -S 127.0.0.1:80");
        die();
    }
    echo "invalid number of parameters";

    $file = fopen('./logs/' . date('Y-m-d') . "-CLI", "a");
    fwrite($file, "CLI call Failed: invalid number of parameters\n\n-----------------\n\n");
    fclose($file);


    die();
}

include 'all.php';

//get offers from api
$curl = curl_init("http://127.0.0.1/apiServer.php");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
curl_close($curl);
//done get offers from api

$reader = new Reader();
$offers = $reader->read($output);

$filter = $argv[1];
$filter_val = $argv[2];
$filter_val_range = $argv[3] ?? null;

$count = filter($offers, $filter, $filter_val, $filter_val_range);

echo "*****************\ncount is: " . $count . "\n*****************\n";

$file = fopen('./logs/' . date('Y-m-d') . "-CLI", "a");
fwrite($file, "CLI call Succeeded: count: $count \n\n-----------------\n\n");
fclose($file);
