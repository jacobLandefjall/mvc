<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test klass för att testa Card klassen.
 * Card-klass i blackjack spelet.
 */
class CardTest extends TestCase
{
    /**
     * Testar att skapa ett kort och kolla att det har rätt egenskaper.
     */
    public function testCreateCard(): void
    {
        // Skapar ett kort och justerar enligt konstruktorn.
        $card = new Card("hearts", "A");

        // Card objektet ska vara av typen Card.
        $this->assertInstanceOf(Card::class, $card);

        // Verifierar att kortet har rätt 'suit'.
        $this->assertEquals("hearts", $card->getSuit());

        // Verifierar att kortet har rätt 'value'.
        $this->assertEquals("A", $card->getValue());

        // Verifierar att kortet är ett ess.
        $this->assertTrue($card->isAce());
    }
}
