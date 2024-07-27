<?php

namespace App\proj;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class Produktion
{
    public static function foodWaste(): array
    {
        return [
            2022 => ['Hushåll' => 587000, 'Hushåll inkl. mat och dryck i avlopp' => 777000, 'Offentlig måltid' => 37000, 
            'Restauranger' => 107000, 'Livsmedelsbutiker' => 89000, 'Grossister' => 13000, 'Livsmedelsindustri' => 305000, 'Primärproduktion' => 92000],

            2021 => ['Hushåll' => 619000, 'Hushåll inkl. mat och dryck i avlopp' => 809000, 'Offentlig måltid' => 33000, 
            'Restauranger' => 65000, 'Livsmedelsbutiker' => 91000, 'Grossister' => 17000, 'Livsmedelsindustri' => 305000, 'Primärproduktion' => 101000],

            2020 => ['Hushåll' => 635000, 'Hushåll inkl. mat och dryck i avlopp' => 825000, 'Offentlig måltid' => 33000, 
            'Restauranger' => 65000, 'Livsmedelsbutiker' => 100000, 'Grossister' => 17000, 'Livsmedelsindustri' => 305000, 'Primärproduktion' => 101000],

            2018 => ['Hushåll' => 693000, 'Hushåll inkl. mat och dryck i avlopp' => 917000, 'Offentlig måltid' => 75000, 
            'Restauranger' => 73000, 'Livsmedelsbutiker' => 100000, 'Grossister' => 0, 'Livsmedelsindustri' => 0, 'Primärproduktion' => 0],

            2016 => ['Hushåll' => 714000, 'Hushåll inkl. mat och dryck i avlopp' => 938000, 'Offentlig måltid' => 73000, 
            'Restauranger' => 71000, 'Livsmedelsbutiker' => 0, 'Grossister' => 0, 'Livsmedelsindustri' => 0, 'Primärproduktion' => 0],

            2014 => ['Hushåll' => 717000, 'Hushåll inkl. mat och dryck i avlopp' => 941000, 'Offentlig måltid' => 70000, 
            'Restauranger' => 66000, 'Livsmedelsbutiker' => 0, 'Grossister' => 0, 'Livsmedelsindustri' => 0, 'Primärproduktion' => 0],

            2012 => ['Hushåll' => 771000, 'Hushåll inkl. mat och dryck i avlopp' => 0, 'Offentlig måltid' => 64000, 
            'Restauranger' => 79000, 'Livsmedelsbutiker' => 0, 'Grossister' => 0, 'Livsmedelsindustri' => 0, 'Primärproduktion' => 0],
        ];
    }

    public static function grennHouse(): array
    {
        return [
            2021 => ['Totala utsläpp' => 87.88, 'Utsläpp i andra länder' => 56.63, 'Utsläpp i Sverige' => 31.25],
            2022 => ['Totala utsläpp' => 80.81, 'Utsläpp i andra länder' => 49.99, 'Utsläpp i Sverige' => 30.82],
            2019 => ['Totala utsläpp' => 90.45, 'Utsläpp i andra länder' => 57.03, 'Utsläpp i Sverige' => 33.42],
            2018 => ['Totala utsläpp' => 96.00, 'Utsläpp i andra länder' => 61.05, 'Utsläpp i Sverige' => 34.94],
            2017 => ['Totala utsläpp' => 94.11, 'Utsläpp i andra länder' => 59.07, 'Utsläpp i Sverige' => 35.05],
            2016 => ['Totala utsläpp' => 96.43, 'Utsläpp i andra länder' => 59.96, 'Utsläpp i Sverige' => 36.47],
            2015 => ['Totala utsläpp' => 95.83, 'Utsläpp i andra länder' => 59.96, 'Utsläpp i Sverige' => 35.87],
            2014 => ['Totala utsläpp' => 96.69, 'Utsläpp i andra länder' => 61.73, 'Utsläpp i Sverige' => 34.96],
            2013 => ['Totala utsläpp' => 102.79, 'Utsläpp i andra länder' => 66.50, 'Utsläpp i Sverige' => 36.29],
            2012 => ['Totala utsläpp' => 102.72, 'Utsläpp i andra länder' => 65.90, 'Utsläpp i Sverige' => 36.81],
            2011 => ['Totala utsläpp' => 111.14, 'Utsläpp i andra länder' => 72.41, 'Utsläpp i Sverige' => 38.74],
            2010 => ['Totala utsläpp' => 105.82, 'Utsläpp i andra länder' => 64.25, 'Utsläpp i Sverige' => 41.58],
            2009 => ['Totala utsläpp' => 92.95, 'Utsläpp i andra länder' => 54.02, 'Utsläpp i Sverige' => 38.92],
            2008 => ['Totala utsläpp' => 110.18, 'Utsläpp i andra länder' => 70.38, 'Utsläpp i Sverige' => 39.81],
        ];
    }
}