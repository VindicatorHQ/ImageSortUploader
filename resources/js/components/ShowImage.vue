<template>
    <div class="w-full bg-gray-800 h-screen">
        <div class="bg-gradient-to-b from-blue-800 to-blue-600 h-96"></div>
        <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
            <div class="bg-gray-900 w-full shadow rounded p-8 sm:p-12 -mt-80">
                <p class="text-3xl font-bold leading-7 text-center text-white mb-5">{{ image['image_name'] }}</p>
                <div class="text-2xl w-full flex flex-col justify-center bg-gray-800 mb-1">
                    <p class="font-bold text-white">Tags:{{ image['tag_names'] }}</p>
                </div>

                <div class="flex items-center justify-center w-full">
                    <img :src="'../storage/images/'+image.image_name" :alt="image.image_name"/>
                </div>

                <div class="flex items-center justify-center w-full mt-9">
                    <a class="mr-10" :href="/updateImage/+image['image_id']">
                        <button class="font-semibold leading-none text-white py-4 px-10 bg-yellow-400 rounded hover:bg-yellow-500 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-600 focus:outline-none">
                            Update Image Tags
                        </button>
                    </a>

                    <a :href="/deleteImage/+image['image_id']">
                        <button class="font-semibold leading-none text-white py-4 px-10 bg-red-700 rounded hover:bg-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:outline-none">
                            Delete Image
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ShowImage",
    props: {
        imageEndpoint: {
            required: true,
            type: String
        },
    },
    data() {
        return {
            image: [],
        }
    },
    methods: {
        getImageById() {
            axios.get(this.imageEndpoint)
                .then((result) => {
                    const apiData = result.data;

                    this.image = apiData.image;
                })
                .catch((error) => {
                    console.log('Error: ', error);
                });
        },
    },
    created() {
        this.getImageById();
    },
    mounted() {
        console.log('ShowImage mounted')
    }
}
</script>
