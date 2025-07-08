<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        return inertia('ContactUs/Index', [
            'contact' => ContactUs::firstOrFail(),
        ]);
    }

}
