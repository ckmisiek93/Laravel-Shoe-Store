<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shoe;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{
    public function shoe_image($id, $size) {
    	$shoe = Shoe::findorFail($id);

        if (is_null($shoe->image)) {
            $img = Image::make('storage/site/shoe_no_image.png')->fit($size)->response('jpg', 90);
        } elseif (strpos($shoe->image, 'http') !== false) {
            $img = Image::make($shoe->image)->fit($size)->response('jpg', 90);
        } else {
            $image_path = asset('storage/shoes/' . $id . '/images/' . $shoe->image);
            $img = Image::make($image_path)->fit($size)->response('jpg', 90);
        }
        return $img;

    }
}
