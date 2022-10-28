<?php
require_once("vendor/autoload.php");

use BotB\Shares\ShareCollection;

$shareCollection = new ShareCollection();
$from = new DateTime("2022-01-01");
$to = new DateTime("2022-10-01");

// $shareCollection->newShareCollection(["ABC", "DEF", "GHI"], $from, $to);

$filePath = "sharesInput.json";
$shareCollection->newShareCollectionFromFile($filePath);