<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        try
        {
            $this->validate($request, [
                'tags' => ['required', 'string'],
                'image' => ['required', 'image', 'mimes:jpeg, png, jpg, gif, svg, webp, gif'],
            ]);
        }
        catch (ValidationException $e) {
            echo $e;
        }

        $imageContent = $request->file('image');

        $filename = Str::random(12);
        $extension = $request->file('image')->getClientOriginalExtension();
        $imageName = $filename.'.'.$extension;

        Storage::disk('public')->put("images/$imageName", file_get_contents($imageContent));

        $image = new Image();
        $image->image_name = $imageName;
        $image->save();

        $tags = $request->get('tags');

        $tags = preg_split("/[\s,]+/", $tags);
        foreach ($tags as $tag)
        {
            $tag_builder = new Tags();
            $tag_builder->image_id = $image->id;
            $tag_builder->tag_name = $tag;
            $tag_builder->save();
        }

        return response([
            'redirect_url' => "/showImage/{$image->id}"
        ]);
    }

    public function updateImage(Request $request, $id)
    {
        try
        {
            $this->validate($request, [
                'tags' => ['required', 'string']
            ]);
        }
        catch (ValidationException $e) {
            echo $e;
        }

        $tags = $request->get('tags');

        $tags = preg_split("/[\s,]+/", $tags);

        Tags::where('image_id', $id)->delete();

        foreach ($tags as $tag)
        {
            $tag_builder = new Tags();
            $tag_builder->image_id = $id;
            $tag_builder->tag_name = $tag;
            $tag_builder->save();
        }

        return response([
            'redirect_url' => "/showImage/{$id}"
        ]);
    }

    public function deleteImage($id)
    {
        $image_file = Image::find($id);

        Storage::disk('public')->delete("images/$image_file[image_name]");
        Image::where('id', $id)->delete();

        return response([
            'redirect_url' => "/showImages"
        ]);
    }
}
