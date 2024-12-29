<?php

namespace App\Http\Controllers\Apis;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\AddTagRequest;
use App\Http\Requests\Tag\SearchTagRequest;
use App\Services\TagService;

class TagController extends Controller
{
    protected $tagService;
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function add(AddTagRequest $request){

        $result = $this->tagService->add($request);
        if($result){

            return sendSuccess('Tag created.', $result);
        }
        return sendError('Tag not added.');
    }

    public function getList(){

        $tags = $this->tagService->getList();

        if($tags){
            return sendSuccess('', $tags);
        }

        return sendError('No tags available.');
    }


    public function search(SearchTagRequest $request){
        
        $tags = $this->tagService->search($request);

        if($tags){
            return sendSuccess('', $tags);
        }

        return sendError('No tags found.');
    }
}
