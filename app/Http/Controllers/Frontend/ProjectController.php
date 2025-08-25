<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function show()
    {
        return view('frontend.projects.show');
    }
} 