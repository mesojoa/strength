<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Mail;


class ProductsController extends Controller
{

    public function show(Category $category)
    {
        $categories = $category->all();
        return view('products.show', compact('categories'));
        
    }

    public function purchase(Product $product)
    {
              
        $subject = 'Confirm!';

        Mail::queue('emails.confirm', ['product' => $product], function($message) use ($subject) 
        {
            $message->from('mesojoa@strength.com', 'Strength.com');
            // hard coded for now. This should come from User
            // $user->email / $user->name
            $message->to('mesojoa@gmail.com', 'Mike Kim')->subject($subject);
        });
 

        return back();
    }
    //
    public function index()
    {
//    	$products = DB::table('products')->get();
		$products = Product::all();
        $categories = Category::all();
    	return view('products.index', compact('categories'));
    }
    
//     public function show(Category $category)
//     {
//    	    // return $category->products;
// //    	$product = Product::find($id);      
//         // $category = Category::with('products')->get();

//         // $category->load('products');
//         // return $category;
//     	return view('products.show',compact('category'));
//     }


}
