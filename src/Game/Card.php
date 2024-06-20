<?php

namespace App\Game;

class Card
{
    private $value; // värde för kortet
    private $color; // färg för kortet
    private $suit; // rank för kortet

    private $suits = [
        'hearts' => '♥',
        'diamonds' => '♦',
        'clubs' => '♣',
        'spades' => '♠'
    ];

    /**
     * Konstruktor
     * @param string $suit
     * @param string $value
     */
    public function __construct($suit, $value)
    {
        $this->suit = $suit;
        $this->value = $value;
        $this->color = $this->setColor($suit);
    }

    /**
     * Sätter färgen på korten
     * @param string $suit
     */
    private function setColor($suit)
    {
        if ($suit == 'hearts' || $suit == 'diamonds') {
            return 'red';
        } else {
            return 'black';
        }
    }

    /**
     * Kollar om kortet är ett ess
     * @return bool
     */
    public function isAce()
    {
        return $this->value == "A";
    }
    /**
     * Hämtar värdet
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returnerar värdet på kortet
     * @return string
     */
    public function getCardValue()
    {
        return $this->value;
    }

    /**
     * Returnerar ranken på kortet
     * @return string
     */
    public function getSuit()
    {
        return $this->suit;
    }

    /**
     * Returnerar färgen på kortet
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    public function __toString()
    {
        return $this->value . $this->suits[$this->suit];
    }

    /**
     * Returnerar kortet som HTML
     * @return string
     */
    public function toHtml()
    {
        return sprintf(
            '<span style="color: %s;">%s%s</span>',
            $this->color,
            $this->value,
            $this->suits[$this->suit]
        );
    }
}
