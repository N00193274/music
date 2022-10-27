<?php

namespace App\Http\Controllers;

use App\Http\Resources\AlbumCollection;
use App\Http\Resources\AlbumResource;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
 * @OA\Get(
 *     path="/api/albums",
 *     description="Displays all the albums",
 *     tags={"Albums"},
     *      @OA\Response(
     *        response=200,
     *        description="OK",
     *      ),
     *      @OA\Response(
     *        response=401,
     *        description="unauthenticated",
     *      ),
     *      @OA\Response(
     *        response=403,
     *        description="Forbidden",
     *      )
 *)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $albums = Album::all();
       // return new AlbumCollection($albums);
        return new AlbumCollection(Album::all());
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @OA\Post(
     *   path="/api/albums",
     *   operationId="store",
     *   tags={"Albums"},
     *   summary="Create new Album",
     *   description="Stores Album in DB",
     *   @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *        required={"title", "genre", "artist", "releaseyear"},
     *        @OA\Property(property="title", type="string", format="string", example="genesis"),
     *        @OA\Property(property="genre", type="string", format="string", example="punk"),
     *        @OA\Property(property="artist", type="string", format="string", example="t-dog"),
     *        @OA\Property(property="releaseyear", type="string", format="string", example="2000")
     *      )
     *   ),
     *   @OA\Response(
     *     response=200, description="database updated",
     *     @OA\JsonContent(
     *       @OA\Property(property="status", type="integer", example=""),
     *       @OA\Property(property="data",type="object")
     *     )
     *   )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $album = Album::create($request->only([
            'title', 'genre', 'artist', 'releaseyear'
        ]));

        return new AlbumResource($album);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        return new AlbumResource($album);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $album->update($request->only([
            'title', 'genre', 'artist', 'releaseyear'
        ]));

        return new AlbumResource($album);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
