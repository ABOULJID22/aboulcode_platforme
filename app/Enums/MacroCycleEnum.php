<?php

namespace App\Enums;

enum MacroCycleEnum: string
{
    case COLLEGE_ONE = '1ère année collège';
    case COLLEGE_TWO = '2ème année collège';
    case COLLEGE_THREE = '3ème année collège';
    case FIRST_BAC = '1ère Bac';
    case SECOND_BAC = '2ème Bac';
    case BAC_PLUS_ONE = 'BAC+1';
    case BAC_PLUS_TWO = 'BAC+2';
    case BAC_PLUS_THREE = 'BAC+3';
    case HIGHER = 'Supérieur';

    public function label(): string
    {
        return $this->value;
    }
}
