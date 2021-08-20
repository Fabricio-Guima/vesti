<?php

namespace App\Http\Controllers;

use App\Classes\Logger;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    private $logger;

	public function __construct()
	{
		$this->logger = new Logger();		
		
	}


    public function index(){

        //log
		$this->logger->log('info', 'Pegou todos os seus produtos.'); 

        return ProductResource::collection(auth()->user()->products);
    }

    public function show(Product $product){
        
        $this->authorize('view',$product);

        $product->load( 'user');


        //log
		$this->logger->log('info', 'Pegou um produto.'); 

        return new ProductResource($product);

    }

    public function update(Product $product, ProductUpdateRequest $request){

       $this->authorize('update',$product);
       
        $input = $request->validated();

        $product->fill($input);
        $product->save();


        //log
		$this->logger->log('info', 'Atualizou um produto.');

        return new ProductResource($product);
    }

    public function destroy(Product $product) {

        $this->authorize('destroy',$product);

        $product->delete();

        //log
		$this->logger->log('info', 'Excluiu um produto.');

        return '';

    }
}
