<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

class TagService {

    public function add($request){

        try {

            $request->name = Str::lower($request->name);
            
            return Tag::create([
                'name' => $request->name
            ]);
        }
        catch(\Exception $e){

            return false;
        }
    }

    public function getList(){

        return Tag::orderBy('name', 'ASC')->get();

    }

    public function search($request){
        
        $query = Str::lower($request->term);
        return Tag::where('name', 'LIKE', '%'.$query.'%')->orderBy('name', 'ASC')->get();

    }

    
}