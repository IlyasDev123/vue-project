<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Services\UserReviewService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use Symfony\Component\HttpFoundation\Response;

class UserReviewController extends Controller
{
    protected $userReviewService;

    /**
     * __construct
     *
     * @param  mixed $userReviewService
     * @return void
     */
    public function __construct(UserReviewService $userReviewService)
    {
        $this->userReviewService = $userReviewService;
    }

    /**
     * @param Type|null $var
     *
     * @return [type]
     */
    public function addReview(StoreReviewRequest $request)
    {
        $data = $this->userReviewService->addReview($request);

       return $data === false ?
            sendError('Something went wrong!', [], Response::HTTP_BAD_REQUEST) :
            sendSuccess('Added review successfully', $data, Response::HTTP_OK);
    }
}
