<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test klass för att testa Card klassen.
 * Card-klass i blackjack spelet.
 * Skapa flera testfall för att verifiera att varje moment i klassen fungerar som det ska.
 */
class HandTest extends TestCase
{
    /**
     * Test kod för att lägga till kort i handen.
     * CreateMock testar isolerade delar av koden.
     * createMock() skapar en mock av klassen Card.
     */
    public function testAddCard(): void
    {
        $hand = new Hand();
        $card = $this->createMock(Card::class, ['suit' => 'Hearts', 'value' => '10']);
        $card->method('getValue')->willReturn('10'); // getValue() returnerar 10.

        $hand->addCard($card);

        $this->assertCount(1, $hand->getCards()); // Kontrollera att det finns 1 kort i handen.
        $this->assertSame($card, $hand->getCards()[0]); // Ser över om det är samma kort.
    }

    /**
     * Test kod för att ta kort.
     */
    public function testGetCard(): void
    { 
        $hand = new Hand(); // Skapar en ny hand.

        $card1 = new Card('hearts', '5');
        $hand->addCard($card1);

        $card2 = new Card('spades', 'K');
        $hand->addCard($card2);

        $this->assertCount(2, $hand->getCards()); // Kontrollera att det finns 2 kort i handen.
        $this->assertSame($card1, $hand->getCards()[0]); // Ser över om det är samma kort.
        $this->assertSame($card2, $hand->getCards()[1]); // Ser över om det är samma kort.

    }

    /**
     * Test kod för att räkna ut handens värde.
     */
    public function testGetHandValue(): void
    {
        $hand = new Hand();

        $card1 = $this->createMock(Card::class);
        $card1->method('getValue')->willReturn('Q');
        $hand->addCard($card1);

        $card2 = $this->createMock(Card::class);
        $card2->method('getValue')->willReturn('5');
        $hand->addCard($card2);

        $this->assertEquals(15, $hand->getHandValue()); // Kontrollera att handens värde är 15.
    }

    /**
     * Test kod för att kolla om handen har blackjack.
     */
    public function testHasBlackjack(): void
    {
        $hand = new Hand();

        $card1 = $this->createMock(Card::class);
        $card1->method('getValue')->willReturn('A');
        $hand->addCard($card1);

        $card2 = $this->createMock(Card::class);
        $card2->method('getValue')->willReturn('K');
        $hand->addCard($card2);

        $this->assertTrue($hand->hasBlackjack()); // Kontrollera att handen har blackjack.
    }

    /**
     * Test kod för att kolla om handen inte har blackjack.
     */
    public function testHasNotBlackjack(): void
    {
        $hand = new Hand();

        $card1 = $this->createMock(Card::class);
        $card1->method('getValue')->willReturn('Q');
        $hand->addCard($card1);

        $card2 = $this->createMock(Card::class);
        $card2->method('getValue')->willReturn('K');
        $hand->addCard($card2);

        $this->assertFalse($hand->hasBlackjack()); // Kontrollera att handen inte har blackjack.
    }
}
