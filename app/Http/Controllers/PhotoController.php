<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\PhotoRequest;
use App\Models\Photo;
use App\Http\Resources\PhotoResource;
use App\Services\PhotoService;
use App\DTO\PhotoDTO;
use App\Models\Modele;
use Illuminate\Http\Response;

class PhotoController extends Controller
{
    //

    private PhotoService $service;

    public function __construct(PhotoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $photo = $this->service->getAll();
        return PhotoResource::collection($photo);
    }

    public function store(PhotoRequest $request,$id)
    {
        // $dto = PhotoDTO::fromRequest($request);

        // $produit = Modele::findOrFail($produitId);
        $photoPaths = [];
        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('produits', 'public');
            $photoPaths[] = $path;
            Photo::create([
                'path' => $path,
                'forein_id' => $id
            ]);
        }



        return response()->json([
            'message' => 'Photos uploaded successfully',
            'photos' => $photoPaths
        ]);
    }

    public function show(Photo $photo)
    {
        return new PhotoResource($photo);
    }

    public function update(PhotoRequest $request, Photo $photo)
    {
        $dto = PhotoDTO::fromRequest($request);
        $updatedPhoto = $this->service->update($photo, $dto);
        return new PhotoResource($updatedPhoto);
    }

    public function destroy(Photo $photo)
    {
        $this->service->delete($photo);
        return response(null, 204);
    }

}
