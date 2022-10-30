<?php

namespace BotB\Shares;

use Cassandra\Date;
use DateTime;
use http\Client\Response;

class Marketstack
{
    private const EOD_ENDPOINT = "/eod";

    private string $apiKey;
    private string $apiBaseUrl;

    public function __construct()
    {
        // TODO: Find out why envs are empty
        $this->apiKey = getenv("MARKETSTACK_API_KEY");
        $this->apiBaseUrl = getenv("MARKETSTACK_API_BASE_URL");

//        $this->apiKey = self::MARKETSTACK_API_KEY;
//        $this->apiBaseUrl = self::MARKETSTACK_API_BASE_URL;
    }

    public function getSharesBySymbols(
        array    $ticker,
        DateTime $from,
        DateTime $to = new DateTime(),
    )
    {
        if ($this->invalidFromToDates($from, $to)) {
            echo "Invalid date for from/to given.\nFrom:" . $from->format("YYYY-MM-DD") .
                " - To: " . $to->format("YYYY-MM-DD");
            return false;
        }

        $tickerParameter = implode(",", $ticker);
        $fromParameter = $from->format("Y-m-d");
        $toParameter = $to->format("Y-m-d");

        $parameter = [
            "symbols" => $tickerParameter,
            "from" => $fromParameter,
            "to" => $toParameter,
        ];

        return $this->post(self::EOD_ENDPOINT, $parameter);
    }

    private function invalidFromToDates(DateTime $from, DateTime $to): bool
    {
        if ($from->getTimestamp() >= $to->getTimestamp()) {
            return true;
        }
        return false;
    }

    private function post($endpoint, array $parameter = [])
    {
        $requestUrl = $this->apiBaseUrl . $endpoint;

        if (!empty($parameter)) {
            $requestUrl .= $this->parameterToUrl($parameter);
        }

        // TODO: Guzzle/Client/Curl here, return response.
        // Return demo-json from marketstack.com/documentation for now
        return json_decode(file_get_contents("demoEodData.json"));
    }

    private function parameterToUrl(array $parameter): string
    {
        $parameterString = "?";
        foreach ($parameter as $key => $param) {
            $parameterString .= $key . "=" . $param . "&";
        }
        return $parameterString;
    }

    public function getHistoricData($symbol, $from, $to = new DateTime('now'))
    {
        // TODO: Implement request, see post()
        return json_decode(file_get_contents("demoEodData.json"), true);
    }
}