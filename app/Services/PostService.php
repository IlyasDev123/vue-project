<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Post;
use App\Models\PostMeta;
use App\Models\PostTag;
use App\Utlities\Constants;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\Constant;

class PostService
{
    
    public function all(){
        
        return Post::with('user')->withCount('userlikesPosts')
        ->when(Auth::user()->type != Constants::ADMIN, function($q){
            $q->where('user_id', Auth::id());
        })
        ->latest()->simplePaginate();
    }
    
    
    /**
     * @return [type]
     */
    public function getAllPosts()
    {
        
        $userType = Auth::user()->type;
        $permission = [Constants::POST_PRIVACY_STATUS['talentEmployers']];
        if($userType == Constants::USER_TYPE_COMPANY){
            $permission[] = Constants::POST_PRIVACY_STATUS['employersOnly'];
        }

        return Post::with('user')->withCount('userlikesPosts')
        ->whereIn('permission_status', $permission)
        ->latest()->simplePaginate();
    }


    /**
     * likeAndUnlike
     *
     * @param  mixed $request
     * @return void
     */
    public function likeAndUnlikePost($request)
    {
        try {
            return auth()->user()->postLikes()->toggle([$request->post_id]);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function create($request){

        DB::beginTransaction();

        try{

            $user = Auth::user();

            $post = Post::create([
                'user_id' => $user->id,
                'title' => $request->title,
                'description' => $request->description,
                'permission_status' => $request->permission_status,
            ]);

            if($request->hasFile('attachment')){
                
                $files = $request->file('attachment');
    
                foreach($files as $file){
                    
                    $attachPath = saveFile($file, Constants::MEDIA_STORAGE_PATH['postAttachment'], 'post_');
                    
                    if($attachPath){
                        
                        $post->postMeta()->create([
                            'file_url' => $attachPath
                        ]);
                    }
                }
            }
            
            if($request->has('tags') && $request->filled('tags')){
                
                $tags = explode(' ', $request->tags);
                foreach($tags as $tag){
                    
                    if(Str::substr($tag, 0, 1) == '#' && Str::length($tag) > 1){
                        $tag = Str::of($tag)->ltrim('#')->lower($tag);
                        
                        $getTag = Tag::updateOrCreate([
                            'name' => $tag
                        ]);
    
                        PostTag::create([
                            'post_id' => $post->id,
                            'tag_id' => $getTag->id,
                        ]);
                    }
                }
            }

            DB::commit();

            $post->refresh();

            return $post;
        }
        catch(\Exception $e){
            
            DB::rollBack();

            return false;
        }
    }

    public function update($request, $id){

        DB::beginTransaction();

        try{

            $post = Post::find($id);
            
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'permission_status' => $request->permission_status, 
            ]);

            PostMeta::where('post_id', $post->id)->delete();
            PostTag::where('post_id', $post->id)->delete();

            if($request->hasFile('attachment')){

                $files = $request->file('attachment');
    
                foreach($files as $file){
                    
                    $attachPath = saveFile($file, Constants::MEDIA_STORAGE_PATH['postAttachment'], 'post_');
                    
                    if($attachPath){
                        
                        $post->postMeta()->create([
                            'file_url' => $attachPath
                        ]);
                    }
                }
            }
            
            if($request->has('tags') && $request->filled('tags')){

                foreach($request->tags as $tag){

                    $getTag = Tag::updateOrCreate([
                        'name' => Str::lower($tag)
                    ]);

                    PostTag::create([
                        'post_id' => $post->id,
                        'tag_id' => $getTag->id,
                    ]);
                }
            }

            DB::commit();

            $post->refresh();

            return $post;
        }
        catch(\Exception $e){
            
            DB::rollBack();

            return false;
        }
    }

    public function delete($id){

        $post = Post::find($id);
        if($post){

            return $post->delete();
        }

        return false;
    }

    public function privacyChange($request){

        DB::beginTransaction();
        try{

            $post = Post::where('id', $request->post_id)
            ->when(Auth::user()->type != Constants::ADMIN, function($q){
                $q->where('user_id', Auth::id());
            })
            ->first();
            if($post){
    
                $post->permission_status = $request->permission_status;
                $post->save();
    
                DB::commit();
                return $post;
            }

            return false;
        }
        catch(\Exception $e){
            DB::rollBack();
            
            return false;
        }

    }
}