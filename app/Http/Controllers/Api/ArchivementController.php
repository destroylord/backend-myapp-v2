<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArchivementResource;
use Illuminate\Http\Request;
use App\Models\Archivement;

class ArchivementController extends Controller
{
   
    /**
     * @OA\Get(
     *     path="/archivement",
     *     summary="Get all Archivements",
     *     tags={"Archivements"},
     *     @OA\Response(response=200, description="Successful response")
     * )
     * 
     */
    public function index()
    {
        return new ArchivementResource(Archivement::paginate());
    }

    /**
     * @OA\Get(
     *     path="/archivement/{id}",
     *     summary="Get Archivement by ID",
     *     tags={"Archivements"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="ID of Archivement",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Successful response"),
     *     @OA\Response(response=404, description="Archivement not found")
     * )
     * 
     */
    public function show($id)
    {
        return new ArchivementResource(Archivement::findOrFail($id));
    }
}
