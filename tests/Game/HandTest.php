<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test klass för att testa Hand klassen.
 * Hand-klass i blackjack spelet.
 */
class HandTest extends TestCase
{
    /**
     * Test kod för funktionen addcard.
     */
    public function testAddCard()
    {
        // Skapar en hand och justerar enligt konstruktorn.
        $hand = new Hand();
        $card = new Card("hearts", "A");
        $hand->addCard($card);

        $this->assertInstanceOf("\App\Game\Hand", $hand);
    }

    /**
     * Test kod för funktionen testHandValue
     */
    public function testHandValue()
    {
        // Skapar en hand och lägger till kort.
        $hand = new Hand();
        $card1 = new Card("hearts", "A");
        $card2 = new Card("spades", "10");
        $hand->addCard($card1);
        $hand->addCard($card2);

        // Förväntat värde av handen.
        $expectedValue = 21;

        // Kontrollera att handens värde är korrekt.
        $this->assertEquals($expectedValue, $hand->getHandValue());
    }
}