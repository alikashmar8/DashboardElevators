<template>
    <div>
        <div class="title m-b-md">
            Add New Elevator:
        </div>
        <div class="alert alert-danger" role="alert" v-show="hasError">
            All fields are required!
        </div>
        <div class="alert alert-success" role="alert" v-show="success">
            Elevator created successfully!
        </div>
        <form action="/elevators" method="post">
            <div class="form-group">
                <label for="name">Elevator Name:</label>
                <input type="text" class="form-control" id="name" required placeholder="Name" name="name"
                       v-model="newElevator.name">
            </div>
            <div class="form-group">
                <label for="index">Index:</label>
                <input type="number" class="form-control" id="index" required placeholder="Index" name="index"
                       v-model="newElevator.index   ">
            </div>

            <div class="form-group">
                <label for="building_id">Building:</label>
                <select class="form-control" id="building_id" name="building_id" v-model="newElevator.building_id">
                    <option v-for="building in this.buildings" :value="building.id">Building Name: {{ building.name}} -
                        Address: {{ building.address}}
                    </option>
                </select>
            </div>

            <button class="btn btn-primary" @click.prevent="createElevator()">
                Add Elevator
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['buildings'],
        name: "Elevators-Create-Component.vue",
        data() {
            return {
                newElevator: {'name': '', 'index': 0, 'building_id': 0},
                hasError: false,
                success: false,
            }
        },
        methods: {
            createElevator: function createElevator() {
                var input = this.newElevator;
                var _this = this;
                this.hasError = false;
                this.success = false;
                if (input['name'] == '' || input['index'] <= 0 || input['building_id'] <= 0) {
                    this.hasError = true;
                    this.success = false;
                } else {
                    axios.post('/elevators', input).then(function (response) {
                        if (response.status === 200) {
                            console.log('success');
                            _this.success = true;
                            _this.newElevator = {'name': '', 'index': 0, 'building_id': 0}
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

<style scoped>

</style>
