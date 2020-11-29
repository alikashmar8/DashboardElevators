<template>
    <div>
        <div class="title m-b-md">
            Add New Manager:
        </div>
        <div class="alert alert-danger" role="alert" v-show="hasError">
            All fields are required!
        </div>
        <div class="alert alert-success" role="alert" v-show="success">
            Building created successfully!
        </div>
        <form action="/managers" enctype="multipart/form-data" method="post">
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
                <label for="profilePicture">Profile Picture:</label>
                <input type="file" @change="imageSelected" class="custom-file-input" id="profilePicture"
                       name="profilePicture">

            </div>

            <button class="btn btn-primary" @click.prevent="createManager()">
                Add Manager
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Managers-Create-Component.vue",
        data() {
            return {
                newManager: {
                    'name': '', 'address': '', 'phoneNumber': '', 'image': null,
                },
                hasError: false,

                success: false,
            }
        },
        methods: {
            imageSelected: function imageSelected(e) {
                this.newManager.image = e.target.files[0];
            },
            createManager: function createManager() {
                let data = new FormData;
                data.append('name', this.newManager.name);
                data.append('address', this.newManager.address);
                data.append('phoneNumber', this.newManager.phoneNumber);
                data.append('image', this.newManager.image);
                var input = this.newManager;
                var _this = this;
                this.hasError = false;
                this.success = false;
                if (input['name'] == '' || input['address'] == '' || input['phoneNumber'] == '') {
                    this.hasError = true;
                    this.success = false;
                } else {
                    this.hasError = false;
                    axios.post('/managers', data).then(function (response) {
                        console.log(response.data);
                        _this.success = true;
                        _this.newManager = {'name': '', 'address': '', 'phoneNumber': ''}
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
