<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    // get all categories 
    public function index(){

        // $categories = Category::all();
        // $categories = Category::with('products');
        // return $categories;

        return  CategoryResource::collection(Category::all());
    }
    // show a specific category
    public function show(Request $request, Category $category){
       
        // pasring params from body 
      //  $bodyId = $request->input('bId');
    //$category = Category::find($bodyId);

    // $category = Category::find($id);
    // $data = $category::with('products');
    $data=$category->load('products') ;
    // // pasring params from path 
      
    //     if (!$category){
    //         return response()->json(
    //             [
    //                 "message" => "category not found",
                   
    //             ],
    //             404
    //             );
    //     }

    //     return response()->json(
    //         [
               
    //             "data" => $data

    //         ]
    //         );

        return new CategoryResource($data);
        
    }

    public function store(Request $request){

       $category =  Category::create($request->all());
        return response()->json(
            
               
               $category

            
            );
    }
    public function destroy($id){

       $category =  Category::find($id);
       if (!$category){
        return response()->json(
            [
                "message" => "category not found",
               
            ],
            404
            );
    }

    $category->delete();
    return response()->json(
        [
           
            "message" => "category successfuly deleted"

        ]
        );
    }
    public function update( Request $request,$id){

       $category =  Category::find($id);
       if (!$category){
        return response()->json(
            [
                "message" => "category not found",
               
            ],
            404
            );
    }

    $category->update($request->all());
    return response()->json(
        $category
           
    
        
        );
    }
}
