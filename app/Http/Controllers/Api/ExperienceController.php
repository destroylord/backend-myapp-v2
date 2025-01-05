<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;
use App\Http\Resources\ExperienceResource;

class ExperienceController extends Controller
{
    public function index()
    {
        return new ExperienceResource(Experience::paginate());
    }

    public function show($id)
    {
        return new ExperienceResource(Experience::findOrFail($id));
    }
}
