<?php

namespace App\Dice;

use App\Dice\Dice;

class DiceHand
{
    /**
     * @var array $hand
     */
    private $hand = [];

    /**
     * Lägg till en tärning
     * @param Dice $die
     * @return void
     */
    public function add(Dice $die): void
    {
        $this->hand[] = $die;
    }

    /**
     * Rulla alla tärningar
     * @return void
     */
    public function roll(): void
    {
        foreach ($this->hand as $die) {
            $die->roll();
        }
    }

    /**
     * Beräkna summan av alla tärningsvärden
     * @return int
     */
    public function getNumberDices(): int
    {
        return count($this->hand);
    }

    /**
     * Få värdet som en int
     * @return int[] Dice värden as integers
     */
    public function getValues(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getValue();
        }
        return $values;
    }

    /**
     * Få värdet som en sträng
     * @return string[] Dice värden as strings
     */
    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getAsString();
        }
        return $values;
    }
}
