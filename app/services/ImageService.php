<?php

namespace App\Services;

use App\Classes\Logger;
use App\Exceptions\UserHasBeenTakenException;
use App\Exceptions\addphotoMaxQuantityException;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Image;
use App\Models\Product;
// use App\Services\ImageService;
use App\Http\Requests\ImageStoreRequest;

class ImageService {

	private $logger;

	public function __construct()
	{
		$this->logger = new Logger();		
		
	}

	
	public function addPhotos(Product $product, $request){
		
		$productUser = auth()->user()->products = $product;
		$productImage = $productUser->images;				
		
		
		if($productImage->count() >= 3) {
			throw new addphotoMaxQuantityException();
			
		}				

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

			//log
			$this->logger->log('info', 'Registrou uma foto.');

			return $img;			

		}
	}

	
}