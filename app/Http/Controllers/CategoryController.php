<?php

namespace App\Http\Controllers;

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
    public function index(){

       return categoryResource::collection(auth()->user()->categories);
    }

    public function show(Category $category){

        $this->authorize('view',$category);
        
        $category->load( 'products');
        
        return new categoryResource($category);
        
    }
    
    public function store(CategoryStore $request){
        
        
        $input = $request->validated();

        $category = auth()->user()->categories()->create($input);

        return new categoryResource($category);

    }

    public function update(Category $category, CategoryUpdateRequest $request){

        $this->authorize('update',$category);

        $input = $request->validated();

        $category->fill($input);
        $category->save();

        return new categoryResource($category->fresh());

    }

    public function destroy(Category $category){

        $this->authorize('destroy',$category);
        
        $category->delete();
        
        return '';
        
    }
    
    public function addProducts(Category $category,ProductStoreRequest $request){
        
        $this->authorize('addCategory',$category);        

        $input = $request->validated();

        $input['code'] = Str::uuid();

        $input['user_id'] = auth()->user()->id;

        $product = $category->products()->create($input);

        return new ProductResource($product);


    }


}
