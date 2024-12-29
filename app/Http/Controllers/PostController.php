<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\Post\LikePostRequest;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    protected $postService;

    /**
     * __construct
     *
     * @param  mixed $postService
     * @return void
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @return [type]
     */
    public function getPosts()
    {
        $posts = $this->postService->getPosts();
        return sendSuccess('Success', $posts, Response::HTTP_OK);
    }

    /**
     * @return [type]
     */
    public function likeAndUnlikePost(LikePostRequest $request)
    {
        $posts = $this->postService->likeAndUnlikePost($request);
        return sendSuccess('Success', $posts, Response::HTTP_OK);
    }
}