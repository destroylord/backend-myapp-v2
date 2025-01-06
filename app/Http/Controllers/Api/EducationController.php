<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EducationResource;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
/**
 * @OA\Get(
 *     path="/education",
 *     tags={"Education"},
 *     summary="Get first education record",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Education not found"
 *     )
 * )
 */

    public function index()
    {
        return new EducationResource(Education::first());
    }
}
