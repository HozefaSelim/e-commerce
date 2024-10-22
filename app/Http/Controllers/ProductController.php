<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    // public function __construct(){
    //     $this->middleware('auth',['except' => ["index" , "show"]]);
    //     $this->middleware('admin',['only' => ["create" , "edit", "store" , "update" , "destroy"]]);
    // }
    

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    //$products = Product::with('category')->paginate(10);
        $query = Product::query();

        if ($request->has("categories") && is_array($request->input('categories'))){
            $query->whereIn('category_id',$request->categories);
        }

        if($request->has('price_min') && $request->has('price_max') ){
            $query->whereBetween('price',[$request->price_min,$request->price_max]);
        }

        
        if ($request->has("category") && $request->input('category') !== 'all'){
            $query->where('category_id',$request->input('category'));
        }

      //  $categories = Category::all();
        $categories = Category::withCount('products')->get();
        $products = $query->get();

        $paginate = $request->input('paginate',2);
        $products = $query->paginate($paginate);
        
        return view('products', compact('products' , 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('products.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handling file upload
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images/products'), $imageName);

            $validatedData['image'] = $imageName;
        }

        // Create the product with the validated data
        $product = Product::create($validatedData);

        // Attach tags if provided
        if ($request->has('tags')) {
            $product->tags()->attach($request->tags);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['variations.options.variation'])->find($id);

       
        return view("product_details", compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $product = Product::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view("products.edit", compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',

        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images/products'), $imageName);

            $validatedData['image'] = $imageName;
        }

        // Update the product with the new data
        $product->update($validatedData);

        // Sync tags if provided
        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        }

        //return redirect()->back();
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->tags()->detach();

        $product->delete();
        return redirect()->route('products.index');
    }

    public function search(Request $request)
    {
        
        // make query on product
        $query = Product::query();

        // search

        if($request->has("query")){
            $query->where('name','LIKE','%'. $request->input('query'). '%');
        }
        // control if you filter with category
        if ($request->has("category") && $request->input('category') !== '0'){
            $query->where('category_id',$request->input('category'));
        }

        
         $products = $query->get();
    // $categories = Category::all();
        //$products = Product::all();
       $categories = Category::withCount('products')->get();
       
        
        return view('products', compact('products' , 'categories'));
    }
}
