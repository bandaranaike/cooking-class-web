<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use Inertia\Response;

class ReviewController extends Controller
{
    const USER_ALIAS_DIR_NAME = "user-alias";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Admin/CreateReview');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReviewRequest $request
     * @return JsonResponse
     */
    public function store(StoreReviewRequest $request): JsonResponse
    {

        $review = new Review();
        $review->rating = $request->get('rating');
        $review->user_name = $request->get('user_name');
        $review->user_country = $request->get('user_country');
        $review->user_image = $this->saveUploadedUserImage($request);
        $review->message = $request->get('message');
        $review->date = Carbon::parse(\DateTime::createFromFormat("D M d Y", $request->get('date')))->format('Y-m-d');
        $review->save();

        return new JsonResponse("Review has been saved successfully!");
    }

    /**
     * @param Request $request
     * @return bool|string
     */
    private function saveUploadedUserImage(Request $request): bool|string
    {
        return $request->hasFile('user_image') ? $request->file('user_image')->store(self::USER_ALIAS_DIR_NAME) : self::USER_ALIAS_DIR_NAME . "/default.png";
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateReviewRequest $request
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
