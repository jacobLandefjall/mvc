<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Blackjack\BlackjackGame;

class BlackjackController extends AbstractController
{
    private $blackjackGame;
    // Kmom03 blackjack

    // Route för game sidan
    #[Route("/game", name: "game")]
    public function game(): Response
    {
        return $this->render('blackjack/game.html.twig');
    }
    #[Route("/game/doc", name: "game_doc")]
    public function doc(): Response
    {
        return $this->render('blackjack/dokumentation.html.twig');

    }
}
