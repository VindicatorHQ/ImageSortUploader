<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $imageName = $filename.'_'.time().'.'.$extension;

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

        return redirect("/showImage/{$image->id}");
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

        return redirect("/showImage/{$id}");
    }

    public function deleteImage($id)
    {
        $image_file = Image::find($id);

        Storage::disk('public')->delete("images/$image_file[image_name]");
        Image::where('id', $id)->delete();

        return redirect('/showImages');
    }
}
