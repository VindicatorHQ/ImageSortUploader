<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view("index");
    }

    public function showImage($id)
    {
        return view("image_pages.showImage");
    }

    public function showImages()
    {
        return view("image_pages.showImages");
    }

    public function imageUpload()
    {
        return view("imagePage.upload");
    }

    public function imageUpdate($id)
    {
        return view("imagePage.updateImage");
    }
}
