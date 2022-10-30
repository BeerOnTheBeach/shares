<?php

namespace BotB\Shares;

use DateTime;

class Value
{
    readonly DateTime $date;
    readonly float $open;
    readonly float $high;
    readonly float $low;
    readonly float $close;
    readonly float $volume;

    public function __construct(
        DateTime $date,
        float    $open,
        float    $high,
        float    $low,
        float    $close,
        float    $volume,
    )
    {
        $this->date = $date;
        $this->open = $open;
        $this->high = $high;
        $this->low = $low;
        $this->close = $close;
        $this->volume = $volume;
    }
}