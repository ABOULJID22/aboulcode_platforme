<?php

namespace App\Services\Orientation;

class MoroccanEducationReference
{
    /**
     * Écoles et établissements d'enseignement supérieur au Maroc
     */
    public static function getSchools(): array
    {
        return [
            'Informatique' => [
                [
                    'name' => 'ENSIAS (École Nationale Supérieure d\'Informatique et d\'Analyse de Systèmes)',
                    'access_level' => 'Excellence',
                    'conditions' => 'Concours très compétitif, très bon dossier requis',
                    'strengths' => 'Leader en informatique, réseau international, placements excellents',
                    'location' => 'Rabat',
                    'type' => 'Grande École',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'ENSA (École Nationale des Sciences Appliquées)',
                    'access_level' => 'Très bon',
                    'conditions' => 'Bon dossier + concours d\'accès',
                    'strengths' => 'Programme généraliste, partenariats industriels',
                    'location' => 'Marrakech, Fes, Khouribga',
                    'type' => 'Grande École',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'EMI (École Mohammadia d\'Ingénieurs)',
                    'access_level' => 'Très bon',
                    'conditions' => 'Excellent dossier académique',
                    'strengths' => 'Réputation solide, forte proportion d\'informatique',
                    'location' => 'Rabat',
                    'type' => 'Grande École',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'INPT (Institut National des Postes et Télécommunications)',
                    'access_level' => 'Très bon',
                    'conditions' => 'Concours d\'accès',
                    'strengths' => 'Spécialisé télécom et IT',
                    'location' => 'Rabat',
                    'type' => 'Institut Spécialisé',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'FST (Faculté des Sciences et Techniques)',
                    'access_level' => 'Accessible',
                    'conditions' => 'Bac scientifique, dossier académique correct',
                    'strengths' => 'Public, abordable, bonne formation de base',
                    'location' => 'Casablanca, Fes, Béni Mellal',
                    'type' => 'Université Publique',
                    'duration' => '3 ans',
                ],
            ],
            'Sciences Mathématiques' => [
                [
                    'name' => 'ENSA (École Nationale des Sciences Appliquées)',
                    'access_level' => 'Très bon',
                    'conditions' => 'Bon dossier + concours',
                    'strengths' => 'Formation mathématiques appliquées forte',
                    'location' => 'Marrakech, Fes, Khouribga',
                    'type' => 'Grande École',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'Faculté des Sciences - Université Mohammed V',
                    'access_level' => 'Accessible',
                    'conditions' => 'Bac scientifique',
                    'strengths' => 'Public, formation de qualité, recherche active',
                    'location' => 'Rabat',
                    'type' => 'Université Publique',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'ENIM (École Nationale d\'Industrie Minérale)',
                    'access_level' => 'Très bon',
                    'conditions' => 'Concours d\'accès',
                    'strengths' => 'Mathématiques appliquées à l\'industrie minière',
                    'location' => 'Rabat',
                    'type' => 'Grande École',
                    'duration' => '3 ans',
                ],
            ],
            'Sciences Physiques' => [
                [
                    'name' => 'EMI (École Mohammadia d\'Ingénieurs)',
                    'access_level' => 'Très bon',
                    'conditions' => 'Excellent dossier',
                    'strengths' => 'Excellence en physique appliquée',
                    'location' => 'Rabat',
                    'type' => 'Grande École',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'ENSA (École Nationale des Sciences Appliquées)',
                    'access_level' => 'Très bon',
                    'conditions' => 'Bon dossier + concours',
                    'strengths' => 'Formation physique appliquée',
                    'location' => 'Marrakech, Fes, Khouribga',
                    'type' => 'Grande École',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'Faculté des Sciences - Université Cadi Ayyad',
                    'access_level' => 'Accessible',
                    'conditions' => 'Bac scientifique',
                    'strengths' => 'Bonne formation scientifique',
                    'location' => 'Marrakech',
                    'type' => 'Université Publique',
                    'duration' => '3 ans',
                ],
            ],
            'Sciences de la Vie' => [
                [
                    'name' => 'Faculté de Médecine - Université Mohammed V',
                    'access_level' => 'Sélectif',
                    'conditions' => 'Très bon dossier + concours',
                    'strengths' => 'Formation médicale réputée',
                    'location' => 'Rabat',
                    'type' => 'Université Publique',
                    'duration' => '6 ans',
                ],
                [
                    'name' => 'Faculté des Sciences de la Vie - Université de Fes',
                    'access_level' => 'Accessible',
                    'conditions' => 'Bac scientifique',
                    'strengths' => 'Biologie, sciences de l\'environnement',
                    'location' => 'Fes',
                    'type' => 'Université Publique',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'ISPITS (Institut Supérieur des Professions Infirmières et Techniques de Santé)',
                    'access_level' => 'Accessible',
                    'conditions' => 'Bac scientifique',
                    'strengths' => 'Formation paramédicale de qualité',
                    'location' => 'Rabat, Casablanca',
                    'type' => 'Institut Spécialisé',
                    'duration' => '2-3 ans',
                ],
            ],
            'Sciences Économiques' => [
                [
                    'name' => 'ENCG (École Nationale de Commerce et de Gestion)',
                    'access_level' => 'Très bon',
                    'conditions' => 'Bon dossier + concours',
                    'strengths' => 'Leader en gestion et commerce',
                    'location' => 'Casablanca, Fes, Marrakech',
                    'type' => 'Grande École',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'ISCAE (Institut Supérieur de Commerce et d\'Administration des Entreprises)',
                    'access_level' => 'Très bon',
                    'conditions' => 'Bon dossier académique',
                    'strengths' => 'Réputé en gestion et finance',
                    'location' => 'Casablanca',
                    'type' => 'Grande École',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'Faculté de Droit et d\'Économie - Université Mohammed V',
                    'access_level' => 'Accessible',
                    'conditions' => 'Bac général',
                    'strengths' => 'Public, formation économique solide',
                    'location' => 'Rabat',
                    'type' => 'Université Publique',
                    'duration' => '3 ans',
                ],
            ],
            'Lettres' => [
                [
                    'name' => 'Faculté des Lettres - Université Mohammed V',
                    'access_level' => 'Accessible',
                    'conditions' => 'Bac général',
                    'strengths' => 'Formation littéraire complète',
                    'location' => 'Rabat',
                    'type' => 'Université Publique',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'ENS (École Nationale Supérieure) - Formation des enseignants',
                    'access_level' => 'Très bon',
                    'conditions' => 'Concours',
                    'strengths' => 'Préparation au professorat',
                    'location' => 'Rabat, Fes',
                    'type' => 'Grande École',
                    'duration' => '3 ans',
                ],
            ],
            'Sciences Humaines' => [
                [
                    'name' => 'Faculté de Lettres et Sciences Humaines - Université Cadi Ayyad',
                    'access_level' => 'Accessible',
                    'conditions' => 'Bac général',
                    'strengths' => 'Sciences humaines et sociales',
                    'location' => 'Marrakech',
                    'type' => 'Université Publique',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'Institut d\'Études Politiques (Sciences Po)',
                    'access_level' => 'Très bon',
                    'conditions' => 'Concours compétitif',
                    'strengths' => 'Sciences politiques, relations internationales',
                    'location' => 'Rabat',
                    'type' => 'Grande École',
                    'duration' => '3 ans',
                ],
            ],
            'Arts et Design' => [
                [
                    'name' => 'ESAV (École Supérieure des Arts Visuels)',
                    'access_level' => 'Sélectif',
                    'conditions' => 'Portfolio, test artistique',
                    'strengths' => 'Arts visuels, design, multimédia',
                    'location' => 'Marrakech',
                    'type' => 'École d\'Art',
                    'duration' => '3 ans',
                ],
                [
                    'name' => 'ESIA (École Supérieure d\'Informatique et Audiovisuel)',
                    'access_level' => 'Accessible',
                    'conditions' => 'Dossier artistique',
                    'strengths' => 'Design graphique, audiovisuel',
                    'location' => 'Rabat',
                    'type' => 'École Spécialisée',
                    'duration' => '3 ans',
                ],
            ],
        ];
    }

    /**
     * Domaines d'études et filières au Maroc
     */
    public static function getFiliereMorocaine(): array
    {
        return [
            [
                'code' => 'SM',
                'name' => 'Sciences Mathématiques',
                'description' => 'Filière scientifique axée sur mathématiques appliquées et physique',
                'subjects' => ['Mathématiques', 'Physique', 'Chimie', 'Philosophie'],
                'universities' => ['Mohammed V', 'Cadi Ayyad', 'Ibnou Zohr'],
            ],
            [
                'code' => 'SP',
                'name' => 'Sciences Physiques',
                'description' => 'Filière scientifique avec focus sur physique et chimie',
                'subjects' => ['Physique', 'Chimie', 'Biologie', 'Mathématiques'],
                'universities' => ['Mohammed V', 'Cadi Ayyad', 'Ibnou Zohr'],
            ],
            [
                'code' => 'SVT',
                'name' => 'Sciences de la Vie et de la Terre',
                'description' => 'Filière scientifique axée sur biologie et sciences de l\'environnement',
                'subjects' => ['Biologie', 'Géologie', 'Écologie', 'Chimie'],
                'universities' => ['Mohammed V', 'Cadi Ayyad', 'Fes', 'Hassan II'],
            ],
            [
                'code' => 'SE',
                'name' => 'Sciences Économiques',
                'description' => 'Filière tournée vers gestion, économie et commerce',
                'subjects' => ['Économie', 'Gestion', 'Droit', 'Mathématiques'],
                'universities' => ['Mohammed V', 'Hassan II', 'Cadi Ayyad'],
            ],
            [
                'code' => 'SA',
                'name' => 'Sciences Agronomiques',
                'description' => 'Filière spécialisée en agriculture et élevage',
                'subjects' => ['Biologie', 'Chimie', 'Agronomie', 'Économie'],
                'universities' => ['Agricole (IAV)', 'Ben M\'sik', 'Marrakech'],
            ],
            [
                'code' => 'L',
                'name' => 'Lettres',
                'description' => 'Filière littéraire classique',
                'subjects' => ['Français', 'Arabe', 'Philosophie', 'Histoire'],
                'universities' => ['Mohammed V', 'Fes', 'Marrakech'],
            ],
            [
                'code' => 'LSH',
                'name' => 'Lettres et Sciences Humaines',
                'description' => 'Filière axée sur sciences humaines et sociales',
                'subjects' => ['Histoire', 'Géographie', 'Sociologie', 'Philosophie'],
                'universities' => ['Mohammed V', 'Fes', 'Cadi Ayyad'],
            ],
            [
                'code' => 'TECH',
                'name' => 'Technologie',
                'description' => 'Filière technique et technologique',
                'subjects' => ['Technologie', 'Physique', 'Mathématiques', 'Informatique'],
                'universities' => ['ENSA', 'INPT', 'FST'],
            ],
            [
                'code' => 'INFO',
                'name' => 'Informatique',
                'description' => 'Filière spécialisée en informatique et programmation',
                'subjects' => ['Informatique', 'Mathématiques', 'Algorithmes', 'Réseaux'],
                'universities' => ['ENSIAS', 'ENSA', 'FST'],
            ],
            [
                'code' => 'GESTION',
                'name' => 'Commerce et Gestion',
                'description' => 'Filière tournée vers commerce et gestion d\'entreprise',
                'subjects' => ['Gestion', 'Commerce', 'Économie', 'Droit'],
                'universities' => ['ENCG', 'ISCAE', 'Université'],
            ],
            [
                'code' => 'ART',
                'name' => 'Arts et Design',
                'description' => 'Filière créative axée sur arts et design',
                'subjects' => ['Arts Visuels', 'Design', 'Histoire de l\'Art', 'Création'],
                'universities' => ['ESAV', 'ESIA', 'Université'],
            ],
        ];
    }

    /**
     * Métiers et opportunités de carrière par domaine
     */
    public static function getCareersDatabase(): array
    {
        return [
            'Informatique' => [
                [
                    'title' => 'Ingénieur Logiciel',
                    'description' => 'Concevoir et développer des logiciels et applications',
                    'education' => 'Bac+5',
                    'outlook' => 'Excellent',
                    'salary_range' => 'Élevé',
                    'demand' => 'Très Élevée',
                ],
                [
                    'title' => 'Développeur Web',
                    'description' => 'Créer et maintenir des sites et applications web',
                    'education' => 'Bac+3 à Bac+5',
                    'outlook' => 'Très bon',
                    'salary_range' => 'Moyen à Élevé',
                    'demand' => 'Très Élevée',
                ],
                [
                    'title' => 'Data Analyst',
                    'description' => 'Analyser et interpréter des données pour des décisions business',
                    'education' => 'Bac+5',
                    'outlook' => 'Excellent',
                    'salary_range' => 'Élevé',
                    'demand' => 'Très Élevée',
                ],
                [
                    'title' => 'Chef de Projet IT',
                    'description' => 'Manager des projets informatiques',
                    'education' => 'Bac+5',
                    'outlook' => 'Excellent',
                    'salary_range' => 'Élevé',
                    'demand' => 'Élevée',
                ],
                [
                    'title' => 'Spécialiste Cybersécurité',
                    'description' => 'Protéger les systèmes informatiques contre les menaces',
                    'education' => 'Bac+5',
                    'outlook' => 'Excellent',
                    'salary_range' => 'Très Élevé',
                    'demand' => 'Très Élevée',
                ],
            ],
            'Sciences' => [
                [
                    'title' => 'Ingénieur Civil',
                    'description' => 'Concevoir et superviser des projets de construction',
                    'education' => 'Bac+5',
                    'outlook' => 'Bon',
                    'salary_range' => 'Élevé',
                    'demand' => 'Bonne',
                ],
                [
                    'title' => 'Scientifique Chercheur',
                    'description' => 'Conduire des recherches scientifiques',
                    'education' => 'Bac+8',
                    'outlook' => 'Bon',
                    'salary_range' => 'Moyen à Élevé',
                    'demand' => 'Bonne',
                ],
            ],
            'Santé' => [
                [
                    'title' => 'Médecin',
                    'description' => 'Diagnostiquer et traiter les maladies',
                    'education' => 'Bac+6 à Bac+8',
                    'outlook' => 'Très bon',
                    'salary_range' => 'Très Élevé',
                    'demand' => 'Élevée',
                ],
                [
                    'title' => 'Infirmier',
                    'description' => 'Prodiguer des soins aux patients',
                    'education' => 'Bac+3',
                    'outlook' => 'Très bon',
                    'salary_range' => 'Moyen',
                    'demand' => 'Très Élevée',
                ],
            ],
            'Commerce' => [
                [
                    'title' => 'Manager Commercial',
                    'description' => 'Manager une équipe commerciale ou région',
                    'education' => 'Bac+3 à Bac+5',
                    'outlook' => 'Bon',
                    'salary_range' => 'Élevé',
                    'demand' => 'Élevée',
                ],
                [
                    'title' => 'Responsable RH',
                    'description' => 'Gérer les ressources humaines d\'une entreprise',
                    'education' => 'Bac+3 à Bac+5',
                    'outlook' => 'Bon',
                    'salary_range' => 'Moyen à Élevé',
                    'demand' => 'Bonne',
                ],
            ],
        ];
    }

    /**
     * Compétences requises par domaine professionnel
     */
    public static function getRequiredSkillsByDomain(): array
    {
        return [
            'IT' => [
                'Programmation',
                'Résolution de problèmes',
                'Pensée logique',
                'Apprentissage autonome',
                'Communication technique',
                'Travail en équipe',
            ],
            'Sciences' => [
                'Méthode scientifique',
                'Analyse',
                'Expérimentation',
                'Communication scientifique',
                'Rigueur',
                'Curiosité intellectuelle',
            ],
            'Gestion' => [
                'Leadership',
                'Communication',
                'Esprit d\'analyse',
                'Gestion du temps',
                'Prise de décision',
                'Négociation',
            ],
            'Créatif' => [
                'Créativité',
                'Innovation',
                'Vision artistique',
                'Communication visuelle',
                'Flexibilité',
                'Prise d\'initiative',
            ],
            'Enseignement' => [
                'Pédagogie',
                'Communication claire',
                'Patience',
                'Leadership',
                'Adaptabilité',
                'Passion pour l\'apprentissage',
            ],
        ];
    }
}
