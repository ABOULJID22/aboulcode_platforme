<?php

namespace App\Enums;

enum TrackBranchEnum: string
{
    case GENERAL = 'Formation générale';
    case SCIENTIFIC = 'Sciences expérimentales';
    case LITERARY = 'Littéraire';
    case ECONOMIC = 'Économie et gestion';
    case TECHNICAL = 'Technique';
    case ENGINEERING = 'Ingénierie';
    case MEDICINE = 'Médecine';
    case LAW = 'Droit';
    case BUSINESS = 'Commerce & Gestion';
    case AGRICULTURE = 'Agriculture';
    case EDUCATION = 'Éducation';
    case ARTS = 'Arts';
    case TECHNOLOGY = 'Technologie';

    public function label(): string
    {
        return $this->value;
    }
}
