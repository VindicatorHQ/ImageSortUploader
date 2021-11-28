<template>
    <div class="w-full bg-gray-800 h-screen">
        <div class="bg-gradient-to-b from-blue-800 to-blue-600 h-96"></div>
        <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
            <div class="bg-gray-900 w-full shadow rounded p-8 sm:p-12 -mt-72">
                <p class="text-3xl font-bold leading-7 text-center text-white mb-5">Image Update Page</p>
                <form @submit.prevent="updateImageTags" enctype="multipart/form-data">
                    <div class="flex items-center justify-center w-full">
                        <img class="w-96, h-96" id="imagePreview" :src="'../storage/images/'+image.image_name" :alt="image.image_name"/>
                    </div>

                    <div>
                        <div class="w-full flex flex-col mt-8">
                            <label class="font-semibold leading-none text-gray-300">Tags (please seperate them by comma to make it easier to search for the tags)</label>
                            <textarea v-model="image.tag_names" name="tags" type="text" class="h-40 text-base leading-none text-gray-50 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-800 border-0 rounded"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full mt-9">
                        <button name="submit" class="mr-10 font-semibold leading-none text-white py-4 px-10 bg-yellow-400 rounded hover:bg-yellow-500 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-600 focus:outline-none">
                            Update Image Tags
                        </button>

                        <button @click="deleteImage" class="font-semibold leading-none text-white py-4 px-10 bg-red-700 rounded hover:bg-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:outline-none">
                            Delete Image
                        </button>
                    </div>

                    <input type="hidden" name="_token" :value="csrf">
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "UpdateImageTags",
    props: {
        imageEndpoint: {
            required: true,
            type: String
        },
    },
    data() {
        return {
            image: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
        updateImageTags() {
            let bodyFormData = new FormData();
            bodyFormData.append("tags", this.image.tag_names)

            const axiosConfig = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            axios.post("/api/updateImage/" + this.image['image_id'], bodyFormData, axiosConfig)
                .then((response) => {
                    window.location = response['data']['redirect_url'];
                }).catch(error => console.log(error));
        },
        deleteImage() {
            axios.delete("/api/deleteImage/" + this.image['image_id'])
                .then((response) => {
                    window.location = response['data']['redirect_url'];
                }).catch(error => console.log(error));
        }
    },
    created() {
        this.getImageById();
    }
}
</script>
