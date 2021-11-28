<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getImagesApi(): array
    {
        $images_ref = Image::all();
        $images = [];

        foreach ($images_ref as $image)
        {
            array_push($images, [
                'id' => $image->id,
                'image_name' => $image->image_name
            ]);
        }

        return [
            "images" => $images
        ];
    }

    public function getImageByIdApi(Request $request): array
    {
        $image = Image::where('image.id', '=', $request->id)
            ->join('tags', 'image.id', '=', 'image_id')
            ->get();

        $image_array = [
            'image_id' => $request->id,
            'tag_names' => $image->implode('tag_name', ", "),
            'image_name' => $image[0]['image_name']
        ];

        return [
            "image" => $image_array
        ];
    }
}
