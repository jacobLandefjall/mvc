<?php

namespace App\Card;

class Card
{
    private $suit;
    private $value;
    private $color;

    private $suits = [
        'hearts' => '♥',
        'diamonds' => '♦',
        'clubs' => '♣',
        'spades' => '♠'
    ];


    public function __construct($suit, $value)
    {
        $this->suit = $suit;
        $this->value = $value;
        $this->color = $this->setColor($suit);
    }

    public function getSuit()
    {
        return $this->suit;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getColor()
    {
        return $this->color;
    }

    private function setColor($suit)
    {
        if ($suit == 'hearts' || $suit == 'diamonds') {
            return 'red';
        } else {
            return 'black';
        }
    }

    public function __toString()
    {
        return sprintf(
            '<span style="color:%s">%s%s</span>',
            $this->color,
            $this->value,
            $this->suits[$this->suit]
        );
    }

}
