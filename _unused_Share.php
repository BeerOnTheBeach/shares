<?php

class _unused_Share
{
    private \DateTime $dateTime;
    private float $low;
    private string $name;
    private float $rendite;
    private int $index;
    private float $buy;
    private string $unique_index;
    private string $ticker;

    /**
     * @return DateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    /**
     * @param DateTime $dateTime
     */
    public function setDateTime(DateTime $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return float
     */
    public function getLow(): float
    {
        return $this->low;
    }

    /**
     * @param float $low
     */
    public function setLow(float $low): void
    {
        $this->low = $low;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getRendite(): float
    {
        return $this->rendite;
    }

    /**
     * @param float $rendite
     */
    public function setRendite(float $rendite): void
    {
        $this->rendite = $rendite;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @param int $index
     */
    public function setIndex(int $index): void
    {
        $this->index = $index;
    }

    /**
     * @return float
     */
    public function getBuy(): float
    {
        return $this->buy;
    }

    /**
     * @param float $buy
     */
    public function setBuy(float $buy): void
    {
        $this->buy = $buy;
    }

    /**
     * @return string
     */
    public function getUniqueIndex(): string
    {
        return $this->unique_index;
    }

    /**
     * @param string $unique_index
     */
    public function setUniqueIndex(string $unique_index): void
    {
        $this->unique_index = $unique_index;
    }

    /**
     * @return string
     */
    public function getTicker(): string
    {
        return $this->ticker;
    }

    /**
     * @param string $ticker
     */
    public function setTicker(string $ticker): void
    {
        $this->ticker = $ticker;
    }

    /**
     * @param DateTime $dateTime
     * @param float $low
     * @param string $name
     * @param float $rendite
     * @param int $index
     * @param float $buy
     * @param string $unique_index
     * @param string $ticker
     */
    public function __construct(DateTime $dateTime, float $low, string $name, float $rendite, int $index, float $buy, string $unique_index, string $ticker)
    {
        $this->dateTime = $dateTime;
        $this->low = $low;
        $this->name = $name;
        $this->rendite = $rendite;
        $this->index = $index;
        $this->buy = $buy;
        $this->unique_index = $unique_index;
        $this->ticker = $ticker;
    }


}
