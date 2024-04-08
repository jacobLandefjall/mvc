<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerTwig extends AbstractController
{
    #[Route("/lucky", name: "lucky_number")]
    public function number(): Response
    {
        $number = random_int(0, 100);
        $mile = random_int(3, 15);
        $foods = ["Havregrynsgröt", "Pannkakor", "Ägg och bacon", "Rostade mackor", "Keso med färska bär"];

        $food = $foods[array_rand($foods)];
        $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Slumpmässig färg

        return $this->render('lucky_number.html.twig', [
            'number' => $number,
            'mile' => $mile,
            'food' => $food, // Skicka maträtten till Twig
            'color' => $color // Skicka färgen till Twig
        ]);
    }

    #[Route("/home", name: "home")]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }
    #[Route("/report", name: "report")]
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }
    #[Route("/api", name: "api")]
    public function api(): Response
{
    $apiRoutes = [
        [
            'namn' => 'API Quote',
            'länk' => 'api_quote', // Ändra till routens namn
            'innehåll' => 'Skriver ut ett slumpmässigt citat.'
        ],
        [
            'namn' => 'API Card',
            'länk' => 'api_deck', // Ändra till routens namn
            'innehåll' => 'EN sida som genererar en kortlek sorterade i värde och färg.'
        ],
        [
            'namn' => 'API Shuffle',
            'länk' => 'api_shuffle', // Ändra till routens namn
            'innehåll' => 'EN sida som genererar en blandad kortlek.'
        ],
        [
            'namn' => 'API Draw',
            'länk' => 'api_draw', // Ändra till routens namn
            'innehåll' => 'En sida som drar ett eller flera kort från kortleken och presenterar det för användaren.'
        ]
    ];

    return $this->render('api.html.twig', [
        'apiRoutes' => $apiRoutes
    ]);
    }
    #[Route("/api/quote", name: "api_quote")]
    public function api_quote(): Response
    {
        $date = new \DateTime(); // Nuvarande tid och datum
        $today = new \DateTime('2024-03-28 13:06:11'); // Ett specifikt datum
        $quote = ["With Great Power Comes Great Responsibility!",
         "May the Force be with you!",
         "Hasta la vista baby!",
          "Do or do not, there is no try!"
        ];
        $quotes = $quote[array_rand($quote)];

        $data = [
            'Dagens citat' => $quotes,
            'Dagens datum' => $date->format('Y-m-d H:i:s'), // Formaterar datumet
            'Tidsstämpel' => $today->format('Y-m-d H:i:s')
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck", name: "api_deck")]
    public function api_card(): JsonResponse
    {
        $cards = [
            'spader' => '♠',
            'hjärter' => '♥',
            'ruter' => '♦',
            'klöver' => '♣'
        ];

        $values = [ '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Knekt', 'Dam', 'Kung', 'Ess'];

        $deck = [];

        foreach ($cards as $card => $symbol) {
            foreach ($values as $value) 
                $deck[$card][] = $symbol . ' ' . $value;
            }
        return new JsonResponse($deck);
    }
    #[Route("/api/shuffle", name: "api_shuffle")]
    public function api_shuffle(Request $request): JsonResponse
    {
        $cards = [
            'spader' => '♠',
            'hjärter' => '♥',
            'ruter' => '♦',
            'klöver' => '♣'
        ];

        $values = [ '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Knekt', 'Dam', 'Kung', 'Ess'];

        $deck = [];

        foreach ($cards as $card => $symbol) {
            foreach ($values as $value) 
                $deck[] = $symbol . ' ' . $value;
            }
        shuffle($deck);

        $session = $request->getSession();
        $session->set('deck', $deck);

        return new JsonResponse($deck);
    }
    #[Route("/api/draw", name: "api_draw")]
    public function api_draw(): Response
    {
        $today = new \DateTime('2024-04-07 17:25:51'); // Ett specifikt datum
        $quote = "En sida som drar ett eller flera kort från kortleken och presenterar det för användaren";
        $quotes = $quote[array($quote)];

        $data = [
            'API Deck' => $quotes,
            'Tidsstämpel' => $today->format('Y-m-d H:i:s')
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
