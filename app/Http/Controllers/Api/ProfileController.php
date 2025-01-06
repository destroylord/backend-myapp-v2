<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
/**
 * @OA\Get(
 *     path="/profile",
 *     summary="Get profile details",
 *     description="Returns profile information",
 *     tags={"Profile"},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         description="Successful operation"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Profile not found"
 *     )
 * )
 */

    public function index()
    {
        return new ProfileResource(Profile::first());
    }
}
