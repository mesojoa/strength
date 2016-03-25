<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Product;
use App\Category;

class AdminController extends Controller
{
    public function listProducts(Category $category)
    {
        $categories = $category->all();
        return view('products.admin', compact('categories'));
    }

    public function addProduct(Request $request, Category $category)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'price' => 'required',
            'name' => 'required'
        ]);

        // Check if category exist in the database
        $categoryInfo = $category->where('name',$request->name)->first();
        $categoryId = empty(($categoryInfo)) ? '' : $categoryInfo->id;
        if( empty($categoryId) ) {
            // adding category first
            $category->name = $request->name;            
            if($category->save()) {
                $categoryId = $category->id;
            }            
        } 

        // adding product          
        $file = $request->file('filefield');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().'.'.$extension, File::get($file));
        
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $categoryId;
        $product->filename = $file->getFilename().'.'.$extension;
        $product->original_filename = $file->getClientOriginalName();
        $product->mime = $file->getClientMimeType();
        $product->save();
              
        return back();
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return back();

    }

    public function editProduct(Request $request, Category $category)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'price' => 'required',
            'name' => 'required'
        ]);

        // return $request->all();

        $category->where('id',$request->category_id)->update(
            ['name' => $request->name]
        );
        
        $product = new Product;
        $product->where('id',$request->product_id)->update(
            ['title' => $request->title,
             'description' => $request->description,
             'price' => $request->price, 
             'category_id' => $request->category_id]
        );
        
        return back();
    }

    public function getImage($filename) 
    {
        $entry = Product::where('filename','=', $filename)->firstOrFail();
        $file = Storage::disk('local')->get($entry->filename);

        return (new Response($file, 200))->header('Content-Type', $entry->mime);

    }




//
    public function store(Request $request, Category $category)
    {    	

    	$this->validate($request, [
    		'title' => 'required|min:5'
    	]);

    	$product = new Product;
    	$product->title = $request->title;
    	$category->products()->save($product);

    	// $product = new Product(['title'=>$request->name]);
    	// $category->products()->save($product);

    	// $category->products()->create([
    	// 	'title' => $request->name    		
    	// ]);

    	// $category->products()->create($request->all());




    	return back();
    }

    // public function editProduct(Product $product)
    // {
    //     return view('products.edit',compact('product'));

    // }

    public function update(Request $request, Product $product)
    {    	
    	$product->update($request->all());
    	return back();

    }
}
