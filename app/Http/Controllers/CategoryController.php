<?php

namespace App\Http\Controllers;

use App\Classes\Logger;
use App\Http\Requests\CategoryStore;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\categoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    private $logger;

	public function __construct()
	{
		$this->logger = new Logger();
		
	}

    public function index(){

       //log
		$this->logger->log('info', 'Pegou todas as categorias.'); 

       return categoryResource::collection(auth()->user()->categories);
    }

    public function show(Category $category){

        $this->authorize('view',$category);
        
        $category->load( 'products');

        //log
		$this->logger->log('info', 'Pegou uma categoria.'); 
        
        return new categoryResource($category);
        
    }
    
    public function store(CategoryStore $request){
        
        
        $input = $request->validated();

        $category = auth()->user()->categories()->create($input);


        //log
		$this->logger->log('info', 'Registrou uma categoria.'); 

        return new categoryResource($category);

    }

    public function update(Category $category, CategoryUpdateRequest $request){

        $this->authorize('update',$category);

        $input = $request->validated();

        $category->fill($input);
        $category->save();


        //log
		$this->logger->log('info', 'Atualizou uma categoria.'); 

        return new categoryResource($category->fresh());

    }

    public function destroy(Category $category){

        $this->authorize('destroy',$category);
        
        $category->delete();


        //log
		$this->logger->log('info', 'Excluiu uma categoria.'); 
        
        return '';
        
    }
    
    public function addProducts(Category $category,ProductStoreRequest $request){
        
        $this->authorize('addCategory',$category);        

        $input = $request->validated();

        $input['code'] = Str::uuid();

        $input['user_id'] = auth()->user()->id;

        $product = $category->products()->create($input);


        //log
		$this->logger->log('info', 'Adicionou uma categoria.'); 

        return new ProductResource($product);


    }


}
