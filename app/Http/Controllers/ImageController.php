<?php

namespace App\Http\Controllers;

use App\Classes\Logger;
use App\Http\Requests\ImageStoreRequest;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    private $imageService;
    private $logger;

    public function __construct(ImageService $imageService){

        $this->imageService = $imageService;
        $this->logger = new Logger();
    }

    public function addPhotos(Product $product,ImageStoreRequest $request){

        $request->validated();

        return $img = $this->imageService->addPhotos($product, $request);
        
    }
    

    public function destroy(Product $product,Image $image){

        $productUser = auth()->user()->products = $product;
		$productImage = $productUser->images = $image;

        //  dd($productImage->name);

        $filePathName = 'image/' . $productImage->name;

        if(file_exists($filePathName)) {
            unlink($filePathName);  
            $productImage->delete();  
        }
        
        
        //log
		$this->logger->log('info', 'Excluiu uma foto.');

         return '';    




        
    }

    
}
