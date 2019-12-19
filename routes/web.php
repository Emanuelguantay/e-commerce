<?php
use App\MailController;

Route::get('/set_language/{lang}','Controller@setLanguage')->name('set_language');

Route::get('login/{driver}','Auth\LoginController@redirectToProvider')->name('social_auth');
Route::get('login/{driver}/callback','Auth\LoginController@handleProviderCallback');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/list', 'HomeController@list')->name('homeList');

Route::group(['prefix'=>'products'], function(){
	Route::group(['middleware' => ['auth']], function(){
		Route::group(['middleware' => [sprintf('role:%s', \App\Role::VENDEDOR || \App\Role::ADMIN)]], function (){
			//Route::resource('products','ProductController');
			Route::get('/create', 'ProductController@create')->name('products.create');
			Route::post('/store', 'ProductController@store')->name('products.store');

			Route::get('/{slug}/edit','ProductController@edit')->name('products.edit');
			Route::put('/{product}/update','ProductController@update')->name('products.update');
			Route::delete('/{product}/destroy','ProductController@destroy')->name('products.destroy');
			Route::post('/{product}/aprobar','ProductController@aprobar')->name('products.aprobar');
		});

		/*
		Route::get('/create', 'ProductController@create')->name('products.create')
			->middleware([sprintf("role:%s", \App\Role::VENDEDOR)]);
		Route::post('/store', 'ProductController@store')->name('products.store')
			->middleware([sprintf("role:%s", \App\Role::VENDEDOR)]);
		*/
	});
	#siempre al ultimo xq es dinamica
	Route::post('/add_review','ProductController@addReview')->name('products.addReview');
	Route::get('/review/{product}', 'ProductController@showReview')->name('products.review.detail');	
	Route::get('/{product}', 'ProductController@show')->name('products.detail');
});


Route::get('/images/{path}/{attachment}', function($path, $attachment){
	//%s-> path y %s->attachment
	$file = sprintf('storage/%s/%s', $path, $attachment);
	if(File::exists($file)){
		return Image::make($file)->response();
	//use php artisan storage:link para reconocer el enlace simbolico
	//comando php artisan storage:linck
	}
});


Route::group(["prefix" => "profile","middleware"=>["auth"]], function(){
	Route::get('/', 'ProfileController@index')->name('profile.index');
	Route::put('/', 'ProfileController@update')->name('profile.update');
});

Route::group(['prefix'=>"vendedor","middleware" => ['auth']], function(){
		Route::get('/products','VendedorController@products')->name('vendedor.products');
	
});


//carrito de compra
//remodelar
Route::group(['prefix'=>'/carro'], function(){
	Route::group(['middleware' => ['auth']],function(){
		Route::post('/store','CartDetailController@store')->name('cart.store');
		//Route::get('/cart', 'CartDetailController@index')->name('cart.index');
		//Route::post('/cart','CartDetailController@destroy')->name('cart.destroy');
	});
});


Route::get('/pago', function () {
    return view ('paypal.pagarconpaypal');
});

Route::post('/pago','PaymentController@index')->name('paypal.index');
Route::post('paypal', 'PaymentController@payWithpaypal');
Route::get('status', 'PaymentController@getPaymentStatus');

//Route::get('/indumentarias','IndumentariaController@index')->name('indumentarias.index');//listado
//Route::get('/indumentarias/create','IndumentariaController@create')->name('indumentarias.create'); //formulario
//Route::post('/indumentarias','IndumentariaController@store')->name('indumentarias.store'); //registrar
//Route::get('/indumentarias/{id}/edit','IndumentariaController@edit')->name('indumentarias.edit'); //formulario edicio
//Route::post('/indumentarias/{id}/edit','IndumentariaController@update')->name('indumentarias.update'); //actulizar
//Route::delete('/indumentarias/{id}','IndumentariaController@destroy')->name('indumentarias.destroy'); //form eliminar

//cambios en cart usando session
//Route::get('/cart/show','CartController@show')->name('cart.show');
Route::POST('/cart/add','CartController@add')->name('cart.add');
Route::get('/cart/show', 'CartController@show')->name('cart.index');
Route::post('/cart/destroy','CartController@destroy')->name('cart.destroy');
Route::get('/cart/update/{product}/{quantity?}','CartController@update')->name('cart.update');

//Segurizar endpoint
Route::group(['middleware' => ['auth']], function(){
		Route::group(['middleware' => [sprintf('role:%s', \App\Role::ADMIN)]], function (){
				Route::resource('/brand', 'BrandController');
				Route::resource('/size', 'SizeController');
				Route::resource('/gender', 'GenderController');
				Route::resource('/indumentaria', 'IndumentariaController');
				Route::resource('/orders', 'OrderAdminController');
				Route::resource('/seller', 'SellerController');
				Route::resource('/customer', 'CustomerController');

				Route::get('/productsize/{id}','ProductSizeController@index')->name('productsize.index');
				Route::resource('/productsize', 'ProductSizeController');
			});
	});



Route::get('/order','OrderController@index')->name('order.index');
Route::get('/order/{id}','OrderController@show')->name('order.detail');
Route::get('descargar-order', 'OrderController@pdf')->name('order.pdf');

Route::get('ranking', 'OrderController@rankingProductOrdenpdf')->name('productRanking.pdf');

Route::get('productsintock', 'OrderController@ProductSinStockOrdenpdf')->name('productSinStock.pdf');
Route::get('rankingMarcas', 'OrderController@RankingMarcasOrdenpdf')->name('marcasRanking.pdf');

//Route::get('/seller','VendedorController@index')->name('seller.index');
//Route::post('/seller/{id}','VendedorController@destroy')->name('seller.destroy');

// para ir a la vista que manda mail
Route::get('/sendMail', function () {
	return view('mail.sendMail');
});
// mail controller
Route::get('/mailSender','MailController@sendMailAll');

//mail prueba
