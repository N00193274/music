<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Http\Resources\ArtistCollection;
use App\Http\Resources\ArtistResource;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @OA\Get(
     *    path="/api/artists",
     *    description="Displays all artists",
     *    tags={"Artists"},
     *         @OA\Response(
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
     *  )
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ArtistCollection(Artist::paginate(1));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @OA\Post(
     *   path="/api/artists",
     *   operationId="store",
     *   tags={"Artists"},
     *   summary="Create new Artist",
     *   description="Stores a new Artist in DB",
     *   @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *        required={"name", "age", "pob"},
     *        @OA\Property(property="name", type="string", format="string", example="swaggerz"),
     *        @OA\Property(property="age", type="string", format="string", example="22"),
     *        @OA\Property(property="pob", type="string", format="string", example="LA"),
     *        )
     * ),
     * @OA\Response(
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
        $artist = Artist::create([
            'name' => $request->name,
            'age' => $request->age,
            'pob' => $request->pob
        ]);

        return new ArtistResource($artist);
    }

    /**
     * Display the specified resource.
     * 
     * @OA\Get(
     *   path="/api/artists/{id}",
     *   description="gets artist by id",
     *   tags={"Artists"},
     *   @OA\Parameter(
     *     name="id",
     *     description="Artist id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *    @OA\Response(
     *        response=200,
     *        description="success",
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
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        return new ArtistResource($artist);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @OA\Put(
     *   path="/api/artists/{id}",
     *   description="gets artist by id",
     *   tags={"Artists"},
     *   @OA\Parameter(
     *     name="id",
     *     description="Artist id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *    @OA\Response(
     *        response=200,
     *        description="success",
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        $artist->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     * 
     *  @OA\Delete(
     *   path="/api/artists/{id}",
     *   operationId="destroy",
     *   tags={"Artists"},
     *   summary="Delete an Artist",
     *   description="Delete Artist",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="id of artist",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *     response=Response::HTTP_NO_CONTENT,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="204"),
     *       @OA\Property(property="data",type="object")
     *       ),
     *     )
     *   )
     * )
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
    }
}
