<?php

namespace App\Http\Controllers\Aboulcode;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use App\Models\Contact;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $projects = Project::latest()->take(6)->get();
        return view('aboulcode.home', compact('projects'));
    }

    public function projects()
    {
        $projects = Project::paginate(12);
        return view('aboulcode.projects.index', compact('projects'));
    }

    public function services()
    {
        $services = Service::all();
        return view('aboulcode.services.index', compact('services'));
    }

    public function blog()
    {
        return view('aboulcode.blog.index');
    }

    public function about()
    {
        return view('aboulcode.about');
    }

    public function contactForm()
    {
        return view('aboulcode.contact');
    }

    public function submitContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'company' => 'nullable|string',
            'budget' => 'nullable|string',
            'subject' => 'nullable|string',
            'message' => 'required|string',
        ]);

        Contact::create($data);

        return redirect()->route('aboulcode.contact')->with('success','Message envoyé.');
    }
}
