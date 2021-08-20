<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function index(){

        return ProductResource::collection(auth()->user()->products);
    }

    public function show(Product $product){
        
        $this->authorize('view',$product);

        $product->load( 'user');

        return new ProductResource($product);

    }

    public function update(Product $product, ProductUpdateRequest $request){

       $this->authorize('update',$product);
       
        $input = $request->validated();

        $product->fill($input);
        $product->save();

        return new ProductResource($product);
    }

    public function destroy(Product $product) {

        $this->authorize('destroy',$product);

        $product->delete();

        return '';

    }
}
