<?php

namespace App\proj;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class HallbarEnergi
{
    public static function energiData(): array
    {
        return [
            '2014' => [63, 63, 19, 51],
            '2015' => [63, 66, 21, 52],
            '2016' => [63, 65, 27, 53],
            '2017' => [64, 66, 27, 53],
            '2018' => [63, 66, 30, 54],
            '2019' => [64, 71, 30, 56],
            '2020' => [66, 74, 32, 60],
            '2021' => [69, 76, 30, 63]
        ];
    }
}