<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;
use App\Http\Resources\ExperienceResource;

class ExperienceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/experience",
     *     tags={"Experience"},
     *     summary="Get list of experiences",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */

    

    public function index()
    {
        return new ExperienceResource(Experience::paginate());
    }

     /**
     * @OA\Get(
     *     path="/experience/{id}",
     *     tags={"Experience"},
     *     summary="Get experience by ID",
     *     @OA\Parameter(
     *         description="ID of experience to return",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Experience not found"
     *     )
     * )
     */

    public function show(string $id)
    {
        return new ExperienceResource(Experience::findOrFail($id));
    }
}
