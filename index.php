<?php
require_once('ShareCollection.php');

$shares = new ShareCollection();
$shares->printShareDataCount();
$shares->create2dArray();
$faultyDates = array_merge($shares->getDatesWithFaultyValues(), $shares->getDatesWithIncompleteData());
print_r("Found " . count(array_unique($faultyDates)) . " unique faulty dates.\n");
$shares->deleteDatesFromDataSet($faultyDates);
$shares->writeToNewCsv();
$shares->printShareDataCount();
