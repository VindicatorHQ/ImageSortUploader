@extends('template.app')
@section('content')
    <div class="w-full bg-gray-800 h-screen">
        <div class="bg-gradient-to-b from-blue-800 to-blue-600 h-96"></div>
        <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
            <div class="bg-gray-900 w-full shadow rounded p-8 sm:p-12 -mt-72">
                <p class="text-3xl font-bold leading-7 text-center text-white mb-5">Image Upload Page</p>
                <form action="/updateImage/{{ $image[0]['id'] }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center justify-center w-full">
                        <img class="w-96, h-96" id="imagePreview" src="{{ asset("storage/images/".$image[0]['image_name']) }}" alt="Your Image"/>
                    </div>
                    <div>
                        <div class="w-full flex flex-col mt-8">
                            <label class="font-semibold leading-none text-gray-300">Tags (please seperate them by comma to make it easier to search for the tags)</label>
                            <textarea type="text" class="h-40 text-base leading-none text-gray-50 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-800 border-0 rounded">
                                @foreach($tags as $tag)
                                    {{ $tag['tag_name'] }},
                                @endforeach
                            </textarea>
                        </div>
                    </div>
                    <div class="flex items-center justify-center w-full">
                        <button class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                            Update Image Tags
                        </button>
                        <a href="/deleteImage/{{ $image[0]['id'] }}">
                            <button class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-red-700 rounded hover:bg-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:outline-none">
                                Delete Image
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
