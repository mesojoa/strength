<?php





//Route::get('/','PagesController@home');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('admin/products', 'AdminController@listProducts');
	Route::post('admin/products/add', 'AdminController@addProduct');
	Route::post('admin/products/delete/{product}', 'AdminController@deleteProduct');
	Route::post('admin/products/edit', 'AdminController@editProduct');
	Route::get('admin/products/{filename}', [
		'as' => 'getimage',
		'uses' => 'AdminController@getImage'
	]);

	Route::get('products','ProductsController@show');
	Route::post('products/purchase/{product}', 'ProductsController@purchase');
    Route::get('/','PagesController@home');
	// Route::get('about','PagesController@about');
	// Route::get('products','ProductsController@index');
	// Route::get('products/{category}','ProductsController@show');

	// Route::post('products/{category}/product','AdminController@store');
	// Route::get('products/{product}/edit','AdminController@editProduct');
	// Route::patch('products/{product}', 'AdminController@update');
});
