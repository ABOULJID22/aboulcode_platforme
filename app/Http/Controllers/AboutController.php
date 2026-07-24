<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Affiche la page À propos
     */
    public function index(): View
    {
        return view('aboulcode.about.index');
    }
}
