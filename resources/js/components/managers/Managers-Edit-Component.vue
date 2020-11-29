<template>
    <div>
        <div class="title m-b-md">
            Edit Manager:
        </div>
        <div class="alert alert-danger" role="alert" v-show="hasError">
            Please check all values or try again later!
        </div>
        <div class="alert alert-success" role="alert" v-show="success">
            Manager edited successfully!
        </div>
        <form enctype="multipart/form-data" method="put">
            <div class="form-group">
                <label for="name">Manager Name:</label>
                <input type="text" class="form-control" id="name" required placeholder="Name" name="name"
                       v-model="newManager.name">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" required placeholder="Address" name="address"
                       v-model="newManager.address">
            </div>


            <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" class="form-control" id="phoneNumber" required placeholder="phoneNumber"
                       name="phoneNumber" v-model="newManager.phoneNumber">
            </div>

            <div class="form-group">
                <label for="profilePicture">Profile Picture:
                    <div class="text-danger">(optional)</div>
                </label>
                <input type="file" @change="imageSelected" class="form-control" id="profilePicture"
                       name="profilePicture">
                <p>Cuurent Image:</p>
                <div v-if="imagePreview" class="mt-3">
                    <img :src="imagePreview" class="figure-img img-fluid rounded" style="max-height:100px;">
                </div>
                <div v-else>
                    <img :src="getImageSrc()" style="width: 250px; height: 250px;">
                </div>

            </div>

            <button class="btn btn-primary" @click.prevent="createManager()">
                Edit Manager
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['manager'],
        name: "Managers-Edit-Component.vue",
        data() {
            return {
                newManager: {
                    'name': this.manager.name,
                    'address': this.manager.address,
                    'phoneNumber': this.manager.phoneNumber,
                    'image': this.manager.profilePicture,
                },
                hasError: false,
                success: false,
                imagePreview: null,
            }
        },
        methods: {

            getImageSrc() {
                return '/storage/profile_images/' + this.newManager.image;
            },
            imageSelected: function imageSelected(e) {
                this.newManager.image = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(this.newManager.image);
                reader.onload = e => {
                    this.imagePreview = e.target.result;
                };
            },
            createManager: function createManager() {
                let data = new FormData();
                data.append('_method', 'PATCH');
                data.append('name', this.newManager.name);
                data.append('address', this.newManager.address);
                data.append('phoneNumber', this.newManager.phoneNumber);
                if (this.newManager.image != null && this.newManager.image != "noImage.jpg") data.append('image', this.newManager.image);
                var input = this.newManager;
                var _this = this;
                this.hasError = false;
                this.success = false;
                if (input['name'] == '' || input['address'] == '' || input['phoneNumber'] == '') {
                    this.hasError = true;
                    this.success = false;
                } else {
                    this.hasError = false;
                    axios.post('/managers/' + this.manager.id, data).then(function (response) {
                        if (response.status === 200) {
                            console.log(response.data);
                            console.log('success');
                            _this.success = true;
                        }
                    }).catch(error => {
                        console.log("Error: " + error);
                        this.success = false;
                        this.hasError = true;
                    });
                }
            },
        }
    }
</script>
