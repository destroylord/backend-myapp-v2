<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArchivementResource;
use Illuminate\Http\Request;
use App\Models\Archivement;

class ArchivementController extends Controller
{
    public function index()
    {
        return new ArchivementResource(Archivement::paginate());
    }

    public function show($id)
    {
        return new ArchivementResource(Archivement::findOrFail($id));
    }
}
