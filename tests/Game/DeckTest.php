<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test klass för att testa Deck klassen.
 * Deck-klass i blackjack spelet.
 */
class DeckTest extends TestCase
{
    public function testCreateDeck(): void
    {
        $deck = new Deck(); // Skapar en ny kortlek.
        $cards = $deck->getCards(); // Hämtar korten från kortleken.

        $this->assertCount(52, $cards); // Kontrollerar att det finns 52 kort i kortleken.
        $suits = ['hearts', 'diamonds', 'clubs', 'spades'];
        $values = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
    }

    public function testShuffleDeck(): void
    {
        $deck = new Deck();
        $notShuffled = $deck->getCards();
        $deck->shuffleDeck();
        $shuffled = $deck->getCards();

        $this->assertNotEquals($notShuffled, $shuffled); // Kontrollerar att kortleken är blandad.
    }

    public function testDrawCard(): void
    {
        $deck = new Deck();
        $count = count($deck->getCards());

        $card = $deck->drawCard();
        $this->assertInstanceOf(Card::class, $card); // Kontrollerar att det är ett kort.
        $this->assertCount($count - 1, $deck->getCards());
    }

    public function testGetCards(): void
    {
        $deck = new Deck();
        $cards = $deck->getCards();

        $this->assertCount(52, $cards); // Kontrollerar att det finns 52 kort i kortleken.
    }
}
