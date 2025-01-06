<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;


class PortfolioController extends Controller
{
    /**
     * @OA\Get(
     *     path="/portofolio",
     *     tags={"Portfolio"},
     *     summary="Get list of portfolios",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function index()
    {
        return new PortfolioResource(Portfolio::paginate());
    }

    /**
     * @OA\Get(
     *     path="/portofolio/{id}",
     *     tags={"Portfolio"},
     *     summary="Get portfolio by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function show($id)
    {
        return new PortfolioResource(Portfolio::find($id));
    }
}
