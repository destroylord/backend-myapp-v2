<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * @OA\Get(
     *     path="/skill",
     *     tags={"Skill"},
     *     summary="Get list of skills",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Skill not found"
     *     )
     * )
     */
    public function index()
    {
        return new SkillResource(Skill::paginate());
    }
}
