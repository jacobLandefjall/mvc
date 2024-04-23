<?php

namespace App\Game;

class Card
{   private $emoji; // emoijs for som kortidentifiering
    private $value; // värde för kortet


    public function __construct($emoji) {
        $this->emoji = $emoji;
        $this->value = $this->cardValue($emoji);
    }

    public function allEmojis() {
        return ["🃑", "🃒", "🃓","🃔","🃕","🃖","🃗","🃘","🃙",
                "🃚","🃜","🃝","🃞","🃎","🃍","🃌","🃊","🃉","🃈","🃇","🃆","🃅","🃄","🃃","🃂",
                "🃁","🂾","🂽","🂼","🂺","🂹","🂸","🂷","🂶","🂵","🂴","🂳","🂲","🂱","🂡","🂢","🂣",
                "🂤","🂥","🂦","🂧","🂨","🂩","🂪","🂬","🂭","🂮"
            ];
    }

    public function cardValue($emoji) {
        
        $values = [
            "🃑" => 11, "🃒" => 2, "🃓" => 3, "🃔" => 4, "🃕" => 5, "🃖" => 6, "🃗" => 7, "🃘" => 8, "🃙" => 9,
            "🃚" => 10, "🃜" => 10, "🃝" => 10, "🃞" => 10, "🃎" => 11, "🃍" => 2, "🃌" => 3, "🃊" => 4, "🃉" => 5, "🃈" => 6, "🃇" => 7, "🃆" => 8, "🃅" => 9, "🃄" => 10, "🃃" => 10, "🃂" => 10,
            "🃁" => 11, "🂾" => 2, "🂽" => 3, "🂼" => 4, "🂺" => 5, "🂹" => 6, "🂸" => 7, "🂷" => 8, "🂶" => 9, "🂵" => 10, "🂴" => 10, "🂳" => 10, "🂲" => 10, "🂱" => 11, "🂡" => 2, "🂢" => 3, "🂣" => 4,
            "🂤" => 5, "🂥" => 6, "🂦" => 7, "🂧" => 8, "🂨" => 9, "🂩" => 10, "🂪" => 10, "🂬" => 10, "🂭" => 10, "🂮" => 10
        ];
        return $values[$emoji] ?? null; // Returnerar null om kortet inte finns i arrayen
    }

    public function isAce() {
        // Returnerar true om kortet är ett ess
        return in_array($this->emoji, ["🃑", "🃎", "🃁", "🂱"]);
    }

    public function __toString() {
        return $this->emoji;
    }

}

    