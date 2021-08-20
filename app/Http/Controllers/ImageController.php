<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageStoreRequest;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function addPhotos(Product $product,ImageStoreRequest $request){

        
        $image = $request->file('image');
        $user = auth()->user()->id;

        if($image && $request->image->isValid()) {   
            
           $destinationPath = 'image/';
           $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
           $image->move($destinationPath, $profileImage);
           $request['name'] = $profileImage;


           $productId = auth()->user()->products = $product;
          

        
           $img = Image::create([
            'product_id' => $productId->id,
			'name' => $profileImage,			
			
		]);

		return $img;


           
           
           
           


            

        }

    }
}
