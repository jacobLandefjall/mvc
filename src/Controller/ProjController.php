<?php

namespace App\Controller;

use App\proj\Energi;
use App\proj\HallbarEnergi;
use App\proj\GoodHealth;
use App\proj\Produktion;
use App\Repository\ProjektRepository;
use App\Entity\Record;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjController extends AbstractController
{
    /**
     * Förstasidan för projektet.
     * Presenterar mätvärderna på webbsidan.
     * @return Response
     */
    #[Route('/proj', name: 'Projekt')]
    public function analys(): Response
     {
        $showEnergi = Energi::showEnergi();
        $hallbarEnergi = HallbarEnergi::energiData();
        $goalOne = GoodHealth::healthGoalOne();
        $goalTwo = GoodHealth::healthGoalTwo();
        $produktionGoal = Produktion::foodWaste();
        $greenHouse = Produktion::grennHouse();

        return $this->render('proj/proj.html.twig', [
        'hallbarEnergi' => $hallbarEnergi,
        'showEnergi' => $showEnergi,
        'goalOne' => $goalOne,
        'goalTwo' => $goalTwo,
        'produktionGoal' => $produktionGoal,
        'greenHouse' => $greenHouse
        ]);
    }

    /**
     * Presenterar projektet.
     * @return Response
     */
    #[Route('/proj/about', name: 'Projekt_about')]
    public function about(): Response
    {
        return $this->render('proj/about.html.twig');
    }

    /**
     * Ansvarar över alla diagram.
     * @return Response
     */
    #[Route('/proj/show', name: 'Projekt_show')]
    public function show(): response
    {
        $showEnergi = Energi::showEnergi();
        $hallbarEnergi = HallbarEnergi::energiData();
        $goalOne = GoodHealth::healthGoalOne();
        $goalTwo = GoodHealth::healthGoalTwo();
        $produktionGoal = Produktion::foodWaste();
        $greenHouse = Produktion::grennHouse();

        return $this->render('proj/show.html.twig', [
            'hallbarEnergi' => $hallbarEnergi,
            'showEnergi' => $showEnergi,
            'goalOne' => $goalOne,
            'goalTwo' => $goalTwo,
            'produktionGoal' => $produktionGoal,
            'greenHouse' => $greenHouse
        ]);
    }

    /**
     * Sparade mätvärden i databasen
     * @param EntityManagerInterface $entityManager
     */
    #[Route('/proj/save', name: 'Projekt_save')]
    public function saveData(EntityManagerInterface $entityManager): Response
    {
        $energi = new Energi();
        $energi->setData('Energi data');
        $entityManager->persist($energi);

        $hallbarEnergi = new HallbarEnergi();
        $hallbarEnergi->setData('Hallbar Energi data');
        $entityManager->persist($hallbarEnergi);

        $goodHealth = new GoodHealth();
        $goodHealth->setData('Good Health data');
        $entityManager->persist($goodHealth);

        $produktion = new Produktion();
        $produktion->setData('Produktion data');
        $entityManager->persist($produktion);

        $entityManager->flush();

        return new Response('Data saved successfully');
    }

}
