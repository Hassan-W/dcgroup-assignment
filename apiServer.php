<?php

namespace myApp;

header('Content-type: application/json');

include 'all.php';

$offers = [];
$offers[] = new Offer(123, "Coffee machine", 35, 390.4);
$offers[] = new Offer(124, "Napkins", 35, 15.5);
$offers[] = new Offer(125, "Chair", 84, 230);

echo json_encode($offers);
die();