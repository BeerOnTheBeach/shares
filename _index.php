<?php
require_once('_ShareCollection.php');

$shares = new _ShareCollection();
$shares->printShareDataCount();
$shares->create2dArray();
$faultyDates = $shares->getDatesWithFaultyValues();
$amountDatesWithFaultyValues = $shares->deleteDatesFromDataSet($faultyDates);
$datesWithWrongAmountShares = 0;
do {
    $faultyDates = $shares->getDatesWithWrongAmountShares();
    $datesWithWrongAmountShares += $shares->deleteDatesFromDataSet($faultyDates);
} while (count($faultyDates) > 0);
print_r("Deleted $amountDatesWithFaultyValues amount dates with faulty values.\n");
print_r("Deleted $datesWithWrongAmountShares dates with wrong amount of shares.\n");
print_r("Deleted " . $datesWithWrongAmountShares + $amountDatesWithFaultyValues. " entries altogether.\n");
$shares->writeToNewCsv();
$shares->printShareDataCount();