<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Product;
use App\Review;
use App\Http\Requests\ProductRequest;
#use App\Mail\NewStudentInCourse;
#use App\Http\Requests\CourseRequest;
use App\Helpers\Helper;

class ProductController extends Controller
{
    public function show (Product $product){
    	$product->load([
    		'marca' => function($q) {
    			$q->select('id','name');
    		},
    		'indumentaria' => function($q){
    			$q->select('id','name');
    		},
    		'genero' => function($q){
    			$q->select('id','name');
    		},
    		//a todas las valoraciones y al usuario al que pertenecen
    		'reviews.user',
            'talles',
    	])->get();
    	//get para extraer la informacion 
    	//dd($product);
        $related= $product->relatedProducts();

    	return view('products.detail', compact('product','related'));
    }

    public function create () {
        $product = new Product;
        $btnText = __("Enviar producto para revisión");
        return view('products.form',compact('product', 'btnText'));
    }

    //con solo poner de parametro ProductRequest ya me hace la validacion!!!!!
    public function store(ProductRequest $product_request){
        
        try{
            //$picture tiene el nombre del archivo guardado!!!!
            $picture = Helper::uploadFile('picture', 'products');
            //mege introducimos una nueva varible picture!!!
            $product_request->merge(['picture' => $picture]);
            $product_request->merge(['status' => Product::PENDING]);
            //dd($product_request->all());
            //dd($product_request->except('_token'));
            $product=Product::create($product_request->input());
            return back()->with('message', ['success', __('Producto cargado correctamente')]);
        } catch (\Exception $exception) {
            return back()->with('message', ['danger', __('Error al guardar')]);
        }

    }


    public function edit ($slug){
        $product = Product::whereSlug($slug)->first();
        $btnText = __("Actualizar producto");
        return view('products.form', compact('product','btnText'));
    }

    public function update(ProductRequest $product_request, Product $product){
        //dd($course_request);
        
        if ($product_request->hasFile('picture')){
            \Storage::delete('products/'.$product->picture);
            $picture = Helper::uploadFile("picture",'products');
            $product_request->merge(['picture'=>$picture]);
        }
        //metodo fill hace todo y input es lo q escribimos
        $product->fill($product_request->input())->save();
        return back()->with('message', ['success', __('Se ha actualizado correctamente')]);
        
    }

    public function destroy (Product $product){
        try{
            $product->delete();
            return back()->with('message', ['success', __('Se ha eliminado correctamente')]);
        } catch (\Exception $exception) {
            return back()->with('message', ['danger', __('Error al eliminar')]);

        }
    }

    public function aprobar (Product $product, $slug){
        dd($slug);
    }

    public function addReview (){
        //dd(request()->all());
        Review::create([
            "user_id" => auth()->id(),
            "product_id" => (int) request('product_id'),
            "rating" => (int) request('rating_input'),
            "comment" => request('message')
        ]);
        return back()->with('message', ['success', __("Muchas gracias por valorar el curso")]);
    }

    public function showReview (Product $product){
        $product->load([
            'marca' => function($q) {
                $q->select('id','name');
            },
            'indumentaria' => function($q){
                $q->select('id','name');
            },
            'genero' => function($q){
                $q->select('id','name');
            },
            //a todas las valoraciones y al usuario al que pertenecen
            'reviews.user',
            'talles',
        ])->get();
        //get para extraer la informacion 
        //dd($product);

        //dd($related);
        return view('review.productReview', compact('product'));
    }

}
