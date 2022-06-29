<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    const HOME_PAGE_REVIEWS_STATUS = 'APPROVED';
    const HOME_PAGE_REVIEWS_LIMIT = 2;

    public function homePage(): Response
    {
        $testimonials = $this->getTopTestimonials();
        return Inertia::render('Welcome', compact('testimonials'));
    }

    /**
     * @return Collection
     */
    private function getTopTestimonials(): Collection
    {
        return Review::whereStatus(self::HOME_PAGE_REVIEWS_STATUS)
            ->select('date', 'message', 'rating', 'user_country', 'user_image', 'user_name')
            ->limit(self::HOME_PAGE_REVIEWS_LIMIT)
            ->inRandomOrder()
            ->get();
    }
}
