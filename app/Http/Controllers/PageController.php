<?php

namespace App\Http\Controllers;


class PageController extends Controller
{
    public function home()
    {
        return view("index");
    }

    public function searchImages()
    {
        return view("imagePage.searchImages");
    }

    public function showImages()
    {
        return view("imagePage.showImages");
    }

    public function showImage($id)
    {
        $imageRoute = route("getImageByIdApi", ['id' => $id]);

        return view("imagePage.showImage", ['image_id' => $imageRoute]);
    }

    public function imageUpload()
    {
        return view("imagePage.upload");
    }

    public function imageUpdate($id)
    {
        $imageRoute = route("getImageByIdApi", ['id' => $id]);

        return view("imagePage.updateImage", ['image_id' => $imageRoute]);
    }
}
