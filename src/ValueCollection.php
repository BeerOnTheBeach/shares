<?php

namespace BotB\Shares;

use Cassandra\Date;
use DateTime;
use Exception;

class ValueCollection
{
    /**
     * @var array<Value>
     */
    private array $valueCollection;

    public function add(Value $share): void
    {
        $this->valueCollection[] = $share;
    }

    public function remove(Value $share): array {
        return $this->valueCollection;
    }

    /**
     * @param array $eodData
     * @return void
     * @throws Exception
     */
    public function newValueCollectionFromHistoricData(array $eodData): void
    {
        foreach ($eodData as $eod) {
            $date = new DateTime($eod['date']);
            $open = (float)$eod['open'];
            $high = (float)$eod['high'];
            $low = (float)$eod['low'];
            $close = (float)$eod['close'];
            $volume = (float)$eod['volume'];

            $value = new Value($date, $open, $high, $low, $close, $volume);

            $this->add($value);
        }
    }
}