<template>
    <div>
        <div class="title m-b-md">
            Edit Building:
        </div>
        <div class="alert alert-danger" role="alert" v-show="hasError">
            Error please check all fields or try again later!
        </div>
        <div class="alert alert-success" role="alert" v-show="success">
            Building Edited successfully!
        </div>
        <form method="put">
            <div class="form-group">
                <label for="name">Building Name:</label>
                <input type="text" class="form-control" id="name" required placeholder="Name" name="name"
                       v-model="newBuilding.name">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" required placeholder="Address" name="address"
                       v-model="newBuilding.address">
            </div>
            <div class="form-group">
                <label for="floors">Floors:</label>
                <input type="number" class="form-control" id="floors" required placeholder="Floors" name="floors"
                       v-model="newBuilding.floors">
            </div>

            <div class="form-group">
                <label for="contactNumber">Contact Number:</label>
                <input type="text" class="form-control" id="contactNumber" required placeholder="contactNumber"
                       name="contactNumber" v-model="newBuilding.contactNumber">
            </div>

            <button class="btn btn-primary" @click.prevent="editBuilding()">
                Edit Building
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['building'],
        name: "Buildings-Edit-Component.vue",
        data() {
            return {
                newBuilding: {
                    'name': this.building.name,
                    'address': this.building.address,
                    'floors': this.building.floors,
                    'contactNumber': this.building.contactNumber
                },
                hasError: false,
                success: false,
            }
        },
        methods: {
            editBuilding: function editBuilding() {
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
                    axios.put('/buildings/' + this.building.id, input).then(function (response) {
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

