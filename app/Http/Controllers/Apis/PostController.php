<?php

namespace App\Http\Controllers\Apis;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Post\LikePostRequest;
use App\Http\Resources\PublicPostsResource;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Post\UpdatePrivacyRequest;

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
    public function all()
    {
        $posts = $this->postService->all();
        return sendSuccess('Success', $posts, Response::HTTP_OK);
    }

    /**
     * @return [type]
     */
    public function getAllPosts()
    {
        $posts = $this->postService->getAllPosts();

        $posts->data = PublicPostsResource::collection($posts);
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

    public function create(CreatePostRequest $request)
    {

        $post = $this->postService->create($request);
        if ($post) {

            return sendSuccess('Post created successfully.', $post);
        }

        return sendError('Post not created, try again!');
    }

    public function update(UpdatePostRequest $request, $id)
    {

        $post = Post::where('id', $id)->first();
        if ($post) {

            $update = $this->postService->update($request, $id);

            if ($update) {
                return sendSuccess('Post updated.', $update);
            }

            return sendError('Post not updated, please try again!');
        }

        return sendError('Post does not exist.');
    }

    public function delete($id)
    {

        $delete = $this->postService->delete($id);
        if ($delete) {
            return sendSuccess('Post deleted.');
        }

        return sendError('Something went wrong, try again!');
    }

    public function privacyChange(UpdatePrivacyRequest $request)
    {

        $result = $this->postService->privacyChange($request);
        if ($result) {
            return sendSuccess('Status updated.', $result);
        }

        return sendError('Status not updated, try again!');
    }
}