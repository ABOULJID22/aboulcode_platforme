<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ServicesController extends Controller
{
    /**
     * Affiche la liste des services
     */
    public function index(): View
    {
        $services = [
            [
                'id' => 1,
                'title' => 'Développement Web',
                'description' => 'Sites web modernes, responsifs et performants',
                'icon' => 'globe',
                'features' => [
                    'Design responsive',
                    'SEO optimisé',
                    'Performance élevée',
                ],
            ],
            [
                'id' => 2,
                'title' => 'Développement Mobile',
                'description' => 'Applications mobiles natives et cross-platform',
                'icon' => 'smartphone',
                'features' => [
                    'iOS & Android',
                    'React Native',
                    'Flutter',
                ],
            ],
            [
                'id' => 3,
                'title' => 'Consultation Digital',
                'description' => 'Stratégie digitale et transformation d\'entreprise',
                'icon' => 'lightbulb',
                'features' => [
                    'Audit digital',
                    'Stratégie web',
                    'Transformation IT',
                ],
            ],
            [
                'id' => 4,
                'title' => 'Design & UX',
                'description' => 'Interfaces intuitives et expériences utilisateur exceptionnelles',
                'icon' => 'palette',
                'features' => [
                    'UI/UX Design',
                    'Prototypage',
                    'Branding',
                ],
            ],
            [
                'id' => 5,
                'title' => 'Maintenance & Support',
                'description' => 'Support technique continu et maintenance d\'application',
                'icon' => 'wrench',
                'features' => [
                    'Support 24/7',
                    'Mises à jour',
                    'Optimisation',
                ],
            ],
            [
                'id' => 6,
                'title' => 'E-Commerce',
                'description' => 'Solutions de vente en ligne complètes et sécurisées',
                'icon' => 'shopping-cart',
                'features' => [
                    'Paiement sécurisé',
                    'Gestion d\'inventaire',
                    'Multi-canaux',
                ],
            ],
        ];

        return view('aboulcode.services.index', ['services' => $services]);
    }
}
