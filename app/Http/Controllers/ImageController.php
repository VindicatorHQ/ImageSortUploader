<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        return view("image_pages.upload");
    }

    public function updateImage(Request $request, $id)
    {
        return view("image_pages.updateImage");
    }

    public function deleteImage(Request $request, $id)
    {
        return view("image_pages.show");
    }
}
