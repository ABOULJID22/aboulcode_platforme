<?php

namespace App\Enums;

enum SpecialtyFamilyEnum: string
{
    case DATA_SCIENCE = 'Data Science';
    case CYBERSECURITY = 'Cybersécurité';
    case CLOUD = 'Cloud Computing';
    case ARTIFICIAL_INTELLIGENCE = 'Intelligence Artificielle';
    case SOFTWARE_DEVELOPMENT = 'Développement Logiciel';
    case BUSINESS_INTELLIGENCE = 'Business Intelligence';
    case PROJECT_MANAGEMENT = 'Gestion de Projet';
    case DIGITAL_MARKETING = 'Marketing Digital';

    public function label(): string
    {
        return $this->value;
    }
}
