<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProjectsController extends Controller
{
    /**
     * Affiche la liste des projets
     */
    public function index(): View
    {
        $projects = [
            [
                'id' => 1,
                'title' => 'Portfolio E-Commerce',
                'description' => 'Plateforme e-commerce moderne avec paiement intégré',
                'image' => '/images/projects/ecommerce.jpg',
                'technologies' => ['Laravel', 'React', 'Stripe'],
                'link' => '#',
            ],
            [
                'id' => 2,
                'title' => 'Application de Gestion',
                'description' => 'Système de gestion d\'entreprise complet et scalable',
                'image' => '/images/projects/management.jpg',
                'technologies' => ['Laravel', 'Vue.js', 'MySQL'],
                'link' => '#',
            ],
            [
                'id' => 3,
                'title' => 'Mobile App Fitness',
                'description' => 'Application mobile pour suivi d\'entraînement',
                'image' => '/images/projects/fitness.jpg',
                'technologies' => ['React Native', 'Firebase'],
                'link' => '#',
            ],
        ];

        return view('aboulcode.projects.index', ['projects' => $projects]);
    }
}
