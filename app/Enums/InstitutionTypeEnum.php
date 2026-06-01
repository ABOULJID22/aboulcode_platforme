<?php

namespace App\Enums;

enum InstitutionTypeEnum: string
{
    case PUBLIC = 'Public';
    case PRIVATE = 'Privé';
    case MILITARY = 'Militaire';
    case SEMI_PUBLIC = 'Semi-Public';

    public function label(): string
    {
        return $this->value;
    }
}
