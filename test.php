<?php
exec('cls');
/**
 * test without params
 */
test("test without params", 'php .\run.php ');

/**
 * test with less params
 */
test("test with less params", 'php .\run.php count_by_id');


/**
 * test with more params
 */
test("test with more params", 'php .\run.php count_by_id 44 extra params');

/**
 * test with undefined filter params
 */
test("test with undefined filter params", 'php .\run.php count_by_id 44');


/**
 * test with non-existing offer id
 */
test("test with non-existing offer id", 'php .\run.php count_by_offer_id 444');


/**
 * test with existing offer id
 */
test("test with existing offer id", 'php .\run.php count_by_offer_id 123');


/**
 * test with non-existing vendor id
 */
test("test with non-existing vendor id", 'php .\run.php count_by_vendor_id 123');


/**
 * test with existing vendor id
 */
test("test with existing vendor id", 'php .\run.php count_by_vendor_id 35');


/**
 * test with existing price format int
 */
test("test with existing price format int", 'php .\run.php count_by_price 230');


/**
 * test with existing price format float
 */
test("test with existing price format float", 'php .\run.php count_by_price 230.0000000');


/**
 * test with unknown format price
 */
test("test with unknown format price", 'php .\run.php count_by_price 2d');


/**
 * test with non-existing price
 */
test("test with non-existing price", 'php .\run.php count_by_price 15');


/**
 * test with existing price range
 */
test("test with existing price range", 'php .\run.php count_by_price_range 12 146');


/**
 * test with multiple-existing price range
 */
test("test with multiple-existing price range", 'php .\run.php count_by_price_range 12 300');


/**
 * test with non-existing price range
 */
test("test with non-existing price range", 'php .\run.php count_by_price_range 12 14');


function test($testTitle, $command)
{
    echo "\n++++++++++++++++++++++++\n$testTitle\nRunning the command: '$command'\n\n";
    exec($command, $out);
    echo implode("\n", $out), "\n";
    echo "\ndone $testTitle\n++++++++++++++++++++++++\n";
}