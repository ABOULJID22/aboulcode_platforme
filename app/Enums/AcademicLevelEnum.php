<?php

namespace App\Enums;

enum AcademicLevelEnum: string
{
    case COLLEGE_ONE = '1ère année collège';
    case COLLEGE_TWO = '2ème année collège';
    case COLLEGE_THREE = '3ème année collège';
    case SCIENCES_MATHS = 'Sciences Mathématiques';
    case SCIENCES_PHYSICS = 'Sciences Physiques';
    case SCIENCES_LIFE = 'Sciences de la Vie';
    case LETTERS_ARABIC = 'Lettres Arabes';
    case LETTERS_FRENCH = 'Lettres Françaises';
    case LETTERS_ENGLISH = 'Lettres Anglaises';
    case LETTERS_PHILOSOPHY = 'Philosophie';
    case ECONOMICS = 'Économie et Gestion';
    case TECHNICAL = 'Technique';
    case BAC_PLUS_ONE = 'BAC+1';
    case BAC_PLUS_TWO = 'BAC+2';
    case BAC_PLUS_THREE = 'BAC+3';
    case HIGHER = 'Supérieur';

    public function label(): string
    {
        return $this->value;
    }
}
