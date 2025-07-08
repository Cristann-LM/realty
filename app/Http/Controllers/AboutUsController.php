<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\OurJourney;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        return inertia('AboutUs/Index', [
            'about' => AboutUs::firstOrFail(),
            'journey' => OurJourney::orderBy('year', 'desc')->get(),
        ]);
    }
}
