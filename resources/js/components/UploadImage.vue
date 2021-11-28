<template>
    <div class="w-full bg-gray-800 min-h-93">
        <div class="bg-gradient-to-b from-blue-800 to-blue-600 h-96"></div>
        <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
            <div class="bg-gray-900 w-full shadow rounded p-8 sm:p-12 -mt-72">
                <p class="text-3xl font-bold leading-7 text-center text-white mb-5">Image Upload Page</p>
                <form @submit.prevent="uploadImage" enctype="multipart/form-data">
                    <div class="flex items-center justify-center w-full">
                        <img class="w-96, h-96" id="imagePreview" src="#" alt="Your Image" style="display: none"/>
                    </div>

                    <div>
                        <div class="w-full flex flex-col mt-8">
                            <label class="font-semibold leading-none text-gray-300">Tags (please seperate them by comma to make it easier to search for the tags)</label>
                            <textarea v-model="image.tags" type="text" name="tags" class="h-40 text-base leading-none text-gray-50 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-800 border-0 rounded"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full mt-9">
                        <label for="imageInput" id="inputButton" class="font-semibold leading-none text-white py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                            Choose Image
                        </label>
                        <input @change="imagePreview()" accept="image/*" type='file' id="imageInput" class="hidden" name="image"/>
                        <button class="font-semibold leading-none text-white py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                            Upload Image
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "UploadImage",
    data() {
        return {
            image: {},
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods: {
        imagePreview() {
            const [file] = imageInput.files
            this.image.image = file;

            if (file)
            {
                document.getElementById("imagePreview").style.display = "block";
                document.getElementById("inputButton").style.display = "none";
                imagePreview.src = URL.createObjectURL(file);
            }
        },
        uploadImage() {
            let bodyFormData = new FormData();
            bodyFormData.append("tags", this.image.tags)
            bodyFormData.append("image", this.image.image)

            const axiosConfig = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            axios.post("/api/uploadImage", bodyFormData, axiosConfig)
            .then((response) => {
                window.location = response['data']['redirect_url'];
            }).catch(error => console.log(error));
        }
    }
}
</script>

