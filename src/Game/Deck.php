<?php

namespace App\Game;

require_once("Card.php"); // inkluderar Card.php

class Deck
{
    private $cards = [];
    // Skapar en konstruktor som skapar en kortlek och blandar den
    public function __construct()
    {
        $this->CreateDeck();
        $this->ShuffleDeck();
    }

    public function CreateDeck()
    { 
        $emojis = ["🃑", "🃒", "🃓","🃔","🃕","🃖","🃗","🃘","🃙",
                "🃚","🃜","🃝","🃞","🃎","🃍","🃌","🃊","🃉","🃈","🃇","🃆","🃅","🃄","🃃","🃂",
                "🃁","🂾","🂽","🂼","🂺","🂹","🂸","🂷","🂶","🂵","🂴","🂳","🂲","🂱","🂡","🂢","🂣",
                "🂤","🂥","🂦","🂧","🂨","🂩","🂪","🂬","🂭","🂮"
            ];
        foreach ($emojis as $emoji) {
            $this->cards[] = new Card($emoji);
        } 
    }
    // Skapar en metod för att blanda kortleken
    public function shuffleDeck()
    {
        shuffle($this->cards);
    }
 // Skapar en metod för att dra kort till spelare
    public function drawCard()
    {
        return array_shift($this->cards);
    }

    // Skapar en metod för att hämta kortleken
    public function getCards()
    {
        return $this->cards;
    }
}