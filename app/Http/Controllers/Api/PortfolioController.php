<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        return new PortfolioResource(Portfolio::paginate());
    }

    public function show($id)
    {
        return new PortfolioResource(Portfolio::find($id));
    }
}
