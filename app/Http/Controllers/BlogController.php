<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Affiche la page du blog
     */
    public function index(): View
    {
        return view('aboulcode.blog.index');
    }
}
