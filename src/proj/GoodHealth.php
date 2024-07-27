<?php

namespace App\proj;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GoodHealth
{
    public static function healthGoalOne(): array
    {
        return [
            '2012' => [4.4],
            '2013' => [6.2],
            '2014' => [3.5],
            '2015' => ['No data'],
            '2016' => ['No data'],
            '2017' => [3.5],
            '2018' => [4.3],
            '2019' => [3.5],
            '2020' => [7.1],
            '2021' => ['No data'],
            '2022' => [4.8],
        ];
    }

    public static function healthGoalTwo(): array
    {
        return [
                '2022' => ['Kvinnor' => [4, 4, 8, 9], 'Män' => [4, 4, 6, 6]],
                '2021' => ['Kvinnor' => [4, 4, 9, 8], 'Män' => [3, 7, 7, 7]],
                '2020' => ['Kvinnor' => [4, 5, 9, 9], 'Män' => [4, 7, 8, 7]],
                '2018' => ['Kvinnor' => [5, 5, 10, 8], 'Män' => [5, 6, 9, 8]],
                '2016' => ['Kvinnor' => [8, 8, 13, 8], 'Män' => [8, 6, 9, 10]],
                '2015' => ['Kvinnor' => [11, 8, 14, 12], 'Män' => [6, 7, 12, 8]],
                '2014' => ['Kvinnor' => [9, 7, 16, 12], 'Män' => [7, 9, 12, 9]],
                '2013' => ['Kvinnor' => [12, 7, 14, 11], 'Män' => [7, 9, 15, 10]],
                '2012' => ['Kvinnor' => [12, 9, 16, 11], 'Män' => [8, 9, 14, 10]],
                '2011' => ['Kvinnor' => [13, 9, 17, 11], 'Män' => [8, 9, 13, 10]],
                '2010' => ['Kvinnor' => [13, 12, 17, 13], 'Män' => [9, 9, 18, 11]],
        ];
        
    }
}