<?php

namespace App\proj;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class Energi
{
    /**
     * Skapar tabler för att visa all data för hållbar energi.
     * @return array
     */
    public static function showEnergi(): array
    {
        $hallbarEnergi = [
        '2016H2' => [53.15, 47.00, 43.97, 41.79, 40.66],
        '2017H2' => [50.96, 45.05, 41.84, 39.50, 38.52],
        '2018H2' => [69.91, 62.07, 58.55, 56.02, 54.96],
        '2019H2' => [68.10, 59.98, 56.19, 53.76, 52.34],
        '2020H2' => [51.28, 47.10, 44.64, 43.04, 42.24],
        '2021H2' => [117.22, 99.94, 93.48, 87.56, 82.55],
        '2022H2' => [212.86, 187.03, 175.61, 166.30, 151.94],
        '2023H2' => [101.31, 88.90, 81.34, 75.66, 72.24]
        ];
        return $hallbarEnergi;
    }
}
