<?php

namespace BotB\Shares;

use DateTime;

class Share
{
    readonly DateTime $buyTime;
    readonly string $fullName;
    readonly string $symbol;
    public ValueCollection $valueCollection;

    public function __construct(
        DateTime        $buyTime,
        string          $fullName,
        string          $symbol,
        ValueCollection $valueCollection = new ValueCollection()
    )
    {
        $this->buyTime = $buyTime;
        $this->fullName = $fullName;
        $this->symbol = $symbol;
        $this->valueCollection = $valueCollection;
    }
}
