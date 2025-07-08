<?php

namespace App\Http\Controllers;

use App\Models\OurTeam;
use Illuminate\Http\Request;

class OurTeamController extends Controller
{
    public function index()
    {
        // Fetch all team members from the database
        return inertia('OurTeam/Index', [
            'teams' => OurTeam::all(),
        ]);
    }
}
