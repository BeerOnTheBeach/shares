<?php

namespace BotB\Shares;

use DateTime;

class ShareCollection
{
    /**
     * @var array<Share>
     */
    private array $shareCollection;
    private Marketstack $marketstack;

    public function __construct()
    {
        $this->marketstack = new Marketstack();
    }

    public function add(Share $share): void
    {
       $this->shareCollection[] = $share;
    }

    public function remove(Share $share): array {
        return $this->shareCollection;
    }

    public function newShareCollection(array $ticker, DateTime $from, DateTime $to = new DateTime("now")): void
    {
        $response = $this->marketstack->getSharesBySymbols($ticker, $from, $to);
        // TODO: Handle response here. See todo-getSharesBySymbols()
        // $sharesJson = json_decode($response->getBody()->serialize());
        $sharesJson = $response->data;

        foreach ($sharesJson as $shareItem) {
            $share = new Share();
            $this->add($share);
        }
    }

    /**
     * @throws \Exception
     */
    public function newShareCollectionFromFile(string $filePath): void
    {
        // TODO: Check if .json or .csv and read accordingly
        // Json-file
        $input = json_decode(file_get_contents("$filePath"), true);

        foreach ($input['shares'] as $shareInput) {
            $symbol = $shareInput['symbol'];
            $buyTime = new DateTime($shareInput['bought']);
            $sold = $shareInput['sold'];
            $historicData = $this->marketstack->getHistoricData($symbol, $buyTime, $sold);

            $valueCollection = new ValueCollection();
            $valueCollection->newValueCollectionFromHistoricData($historicData['data']);

            $share = new Share(
                $buyTime,
                $symbol,
                $symbol,
                $valueCollection
            );

            $this->add($share);
        }

        var_dump($this->shareCollection);

        die;
        $response = "";

    }
}