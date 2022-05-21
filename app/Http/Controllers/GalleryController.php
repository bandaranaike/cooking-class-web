<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $galleries = Gallery::whereStatus('ACTIVE')->with("images")->get();
        return Inertia::render('Gallery/GalleryIndex', compact('galleries'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Gallery/GalleryCreate');
    }

    /**
     * Show the gallery list.
     *
     * @return Response
     */
    public function list(): Response
    {
        $galleries = $this->getGalleriesList();
        return Inertia::render('Gallery/GalleryManager', compact('galleries'));
    }

    /**
     * @return Builder[]|Collection
     */
    public function getGalleriesList(): Collection|array
    {
        return Gallery::with('images')->get();
    }

    /**
     * @param Gallery $gallery
     * @param Request $request
     * @return void
     */
    public function uploadImages(Gallery $gallery, Request $request): void
    {
        $this->saveImages($gallery, $request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGalleryRequest $request
     * @return JsonResponse
     */
    public function store(StoreGalleryRequest $request): JsonResponse
    {
        $gallery = new Gallery();
        $gallery->title = $request->get('title');
        $gallery->public_id = Str::uuid()->toString();
        $gallery->description = $request->get('description');
        $gallery->slug = $request->get('slug');
        $gallery->save();

        $this->saveImages($gallery, $request);

        return new JsonResponse("Gallery Created!");

    }

    /**
     * @param Gallery $gallery
     * @param Request $request
     * @return void
     */
    private function saveImages(Gallery $gallery, Request $request): void
    {
        $saving_image_objects = [];
        foreach ($request->file('images') as $file) {
            $gallery_image = new GalleryImage();
            $gallery_image->image = $file->store('gallery');
            $gallery_image->public_id = Str::uuid()->toString();
            $saving_image_objects[] = $gallery_image;
        }

        $gallery->images()->saveMany($saving_image_objects);
    }

    /**
     * Display the specified resource.
     *
     * @param Gallery $gallery
     * @return Response
     */
    public function show(Gallery $gallery): Response
    {
        //dd($gallery);
        $gallery->load('images:gallery_id,image as src,image as thumbnail');
        return Inertia::render('Gallery/GalleryView', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateGalleryRequest $request
     * @param Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Gallery $gallery
     * @return JsonResponse
     */
    public function destroy(Gallery $gallery): JsonResponse
    {
        Storage::delete($gallery->images->map(fn($image) => $image->image)->toArray());
        $gallery->images()->delete();
        $gallery->delete();
        return new JsonResponse("Deleted");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GalleryImage $galleryImage
     * @return JsonResponse
     */
    public function destroyImage(GalleryImage $galleryImage): JsonResponse
    {
        if (Storage::delete($galleryImage->image)) {
            $message = $galleryImage->image . " deleted!";
            $galleryImage->delete();
            return new JsonResponse($message);
        } else {
            return new JsonResponse("Deleting image was not success!", 400);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkAvailableSlug(Request $request): JsonResponse
    {
        $count = 1;
        $slug = $original_slug = Str::slug($request->get('title'));
        while (Gallery::whereSlug($slug)->count()) {
            $slug = $original_slug . "-" . $count;
            $count++;
        }
        return new JsonResponse($slug);
    }
}
