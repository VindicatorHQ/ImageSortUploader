<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tags;

class PageController extends Controller
{
    public function home()
    {
        return view("index");
    }

    public function showImages()
    {
        $images = Image::all();

        return view("imagePage.showImages", ["images" => $images]);
    }

    public function showImage($id)
    {
        $image = Image::where('id', '=', $id)->get();
        $tags = Tags::where('image_id', '=', $id)->get();

        return view("imagePage.showImage", [
            "image" => $image,
            "tags" => $tags
        ]);
    }

    public function imageUpload()
    {
        return view("imagePage.upload");
    }

    public function imageUpdate($id)
    {
        $image = Image::where('id', '=', $id)->get();
        $tags = Tags::where('image_id', '=', $id)->get();

        return view("imagePage.updateImage", [
            "image" => $image,
            "tags" => $tags
        ]);
    }
}
