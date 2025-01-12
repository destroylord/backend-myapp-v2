<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioResource;
use App\Http\Resources\PortfolioSingleResource;
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
     *     path="/portofolio/{slug}",
     *     tags={"Portfolio"},
     *     summary="Get portfolio by slug",
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function show($slug)
    {
        $qry = Portfolio::where('slug', $slug)->firstOrFail();
        return new PortfolioSingleResource($qry);
    }
}
