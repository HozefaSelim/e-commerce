<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Traits\ReturnTrait;

class TagController extends Controller
{

    use ReturnTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return TagResource::collection($tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {

       
        Tag::create($request->all());

        return $this->returnSuccess("tag has been created suuccessfuly",200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $tag = Tag::find($id);

        if(!$tag){
            return $this->returnError("tag not found",404);
        }
        return $this->returnData("tag",new TagResource($tag),"successed opertation",200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag = Tag::find($id);

        if(!$tag){
            return $this->returnError("tag not found",404);
    
        }

        $tag->update($request->all());
        return $this->returnData("tag",new TagResource($tag),"Tag updated successfuly",200);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);

        if(!$tag){
            return $this->returnError("tag not found",404);
    
        }

        $tag->delete();
        return $this->returnSuccess("Tag deleted successfuly",200);
    }

  
  
  
    public function filter(Request $request){
            $key = $request->input('key');
            return Tag::where("name",$key)->get();
    }
}
