<template>
    <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center min-h-screen sm:pt-0 pb-5">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-12">
            <p class="text-3xl font-bold leading-7 text-center text-white mt-5">All Images</p>
            <div class="grid md:grid-cols-4">

                <div v-for="image in images" class="p-6">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-80">
                            <img class="h-96 rounded" :src="'../storage/images/'+image.image_name" alt="The image:tm:"/>
                        </div>
                    </div>

                    <div class="ml-4 text-lg leading-7 font-semibold">
                        <a :href="/showImage/+image.id" class="text-gray-900 dark:text-white">Open Image</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ShowImages",
    props: {
        imagesEndpoint: {
            required: true,
            type: String
        },
    },
    data() {
        return {
            images: [],
        }
    },
    methods: {
        getImages() {
            axios.get(this.imagesEndpoint)
                .then((result) => {
                    const apiData = result.data;

                    this.images = apiData.images;
                })
                .catch((error) => {
                    console.log('Error: ', error);
                });
        },
    },
    created() {
        this.getImages();
    }
}
</script>

