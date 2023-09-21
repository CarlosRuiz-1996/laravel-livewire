<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
class ImageController extends Controller
{

    public function getImage($filename)
    {
        $file = Storage::disk('products')->get($filename);
       
        return new Response($file, 200);
    }
}
