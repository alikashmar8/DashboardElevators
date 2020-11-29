<template>
    <div>
        <div class="title m-b-md">
            Add New Building:
        </div>
        <div class="alert alert-danger" role="alert" v-show="hasError">
            All fields are required!
        </div>
        <div class="alert alert-success" role="alert" v-show="success">
            Building created successfully!
        </div>
        <form action="/buildings" method="post">
            <div class="form-group">
                <label for="name">Building Name</label>
                <input type="text" class="form-control" id="name" required placeholder="Name" name="name"
                       v-model="newBuilding.name">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" required placeholder="Address" name="address"
                       v-model="newBuilding.address">
            </div>
            <div class="form-group">
                <label for="floors">Floors</label>
                <input type="number" class="form-control" id="floors" required placeholder="Floors" name="floors"
                       v-model="newBuilding.floors   ">
            </div>

            <div class="form-group">
                <label for="contactNumber">Contact Number</label>
                <input type="text" class="form-control" id="contactNumber" required placeholder="contactNumber"
                       name="contactNumber" v-model="newBuilding.contactNumber">
            </div>

            <button class="btn btn-primary" @click.prevent="createBuilding()">
                Add Building
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Buildings-Create-Component",
        data() {
            return {
                newBuilding: {'name': '', 'address': '', 'floors': 0, 'contactNumber': ''},
                hasError: false,
                success: false,
            }
        },
        methods: {
            createBuilding: function createBuilding() {
                var input = this.newBuilding;
                var _this = this;
                this.hasError = false;
                this.success = false;
                if (input['name'] == ''
                    || input['address'] == '' || input['floors'] <= 0 || input['contactNumber'] == ''
                ) {
                    this.hasError = true;
                    this.success = false;
                } else {
                    this.hasError = false;
                    axios.post('/buildings', input).then(function (response) {
                        console.log(response.data);
                        // if(response.data == 'success'){
                        // }
                        _this.success = true;
                        _this.newBuilding = {'name': '', 'address': '', 'floors': 0, 'contactNumber': ''}
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

<style scoped>

</style>
