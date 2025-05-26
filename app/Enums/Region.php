<?php

namespace App\Enums;

enum Region: string
{
    case Arusha = 'Arusha';
    case Dar_es_Salaam = 'Dar es Salaam';
    case Dodoma = 'Dodoma';
    case Mwanza = 'Mwanza';
    case Mbeya = 'Mbeya';
    case Morogoro = 'Morogoro';
    case Tanga = 'Tanga';
    case Kilimanjaro = 'Kilimanjaro';
    case Zanzibar = 'Zanzibar';
    case Other = 'Other';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}