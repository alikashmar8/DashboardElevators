<template>
    <div>
        <div class="row mt-3 mb-4">
            <div class="col-md-9">
                <h2>Buildings Available:</h2>
            </div>
            <div class="col-md-3">
                <a href="/buildings/create" class="btn btn-info">Create New Building</a>
            </div>
        </div>
        <ol>
            <div v-for="building in this.buildings">
                <div class="row">
                    <li></li>
                    <div class="col-md-8">
                        <h4><span class="font-weight-bold mr-3">Building Name:</span>{{building.name}}</h4>
                        <div v-if="building.managers.length > 0">
                            <h6 class="font-weight-bold">Building Managers:</h6>
                            <ul>
                                <li v-for="manager in building.managers">{{manager.name}}</li>
                            </ul>
                        </div>
                        <div v-else>
                            <h5 class="text-secondary">No managers in this building</h5>
                        </div>
                        <div v-if="building.managers.length > 0">
                            <h6 class="font-weight-bold">Building Elevators:</h6>
                            <ul>
                                <li v-for="elevator in building.elevators">{{elevator.name}}</li>
                            </ul>
                        </div>
                        <div v-else>
                            <h5 class="text-secondary">No elevators in this building</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a :href="getEditUrl(building.id)" class="btn btn-secondary mx-3">Edit</a>
                        <button class="btn btn-danger" data-target="#deleteModal" data-toggle="modal"
                                @click.prevent="changeId(building.id)">Delete
                        </button>
                    </div>
                </div>
                <hr>
            </div>
        </ol>

        <!--        Delete Modal (Pop Up)-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to
                            delete ?</h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-danger">Please notice by deleting this building all elevators related to it will
                            be deleted too</h5>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <input type="submit" class="btn btn-danger" value="Delete"
                               @click.prevent="deleteBuilding()">
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['buildings'],
        name: "Buildings-Component.vue",
        data() {
            return {
                id: 0,
            }
        },
        methods: {
            getEditUrl(id) {
                return "/buildings/" + id + "/edit";
            },
            changeId(param) {
                this.id = param;
            },
            deleteBuilding() {
                axios.delete("/buildings/" + this.id).then(function (response) {
                    console.log(response);
                    window.location.reload();
                }).catch(error => {
                    console.log("Error: " + error);
                });
            }
        }
    }
</script>

