<?php

namespace BotB\Shares;

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

    public function newShareCollection(array $ticker, \DateTime $from, \DateTime $to = new \DateTime("now")): void
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

    public function newShareCollectionFromFile(string $filePath)
    {
        // TODO: Check if .json or .csv and read accordingly
        // Json-file
        $input = json_decode(file_get_contents("$filePath"));

        foreach ($input->shares as $shareInput) {
            $symbol = $shareInput->symbol;
            $from = $shareInput->from;
            $to = $shareInput->to;
            $historicData = $this->marketstack->getHistoricData($symbol, $from, $to);
        }
        die;
        $response =

    }
}