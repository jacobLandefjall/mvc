<?php

namespace App\Card;

class CardGraphic extends Card
{
    public function __construct($suit, $value)
    {
        parent::__construct($suit, $value);

    }

    public function getGraphic(): string
    {
        $suits = [
            'hearts' => '♥',
            'diamonds' => '♦',
            'clubs' => '♣',
            'spades' => '♠'
        ];

        return $this->getValue() . $suits[$this->getSuit()];
    }


}
/*use App\Card\Card;
$card = new CardGraphic('hearts', 'A');

$graphic = $card->getGraphic();

echo $graphic;*/
