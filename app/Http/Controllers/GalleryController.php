<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        return Inertia::render('Admin/GalleryCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGalleryRequest $request
     * @return void
     */
    public function store(StoreGalleryRequest $request)
    {
        $gallery = new Gallery();
        $gallery->title = $request->get('title');
        $gallery->description = $request->get('description');
        $gallery->slug = $request->get('slug');
        $gallery->save();

        $this->saveImages($gallery, $request);

    }

    /**
     * @param Gallery $gallery
     * @param Request $request
     * @return void
     */
    private function saveImages(Gallery $gallery, Request $request)
    {
        $saving_image_objects = [];
        foreach ($request->file('images') as $file) {
            $gallery_image = new GalleryImage();
            $gallery_image->image = $file->store('gallery');
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {

    }

    public function checkAvailableSlug(Request $request)
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
