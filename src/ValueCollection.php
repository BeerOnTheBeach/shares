<?php

namespace BotB\Shares;

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
}