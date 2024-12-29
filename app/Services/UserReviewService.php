<?php

namespace App\Services;

use App\Models\UserReview;

class UserReviewService
{

    public function addReview($request)
    {
        try {
            return  UserReview::create($request->except(['token']));
        } catch (\Throwable $th) {
            return false;
        }
    }
}
