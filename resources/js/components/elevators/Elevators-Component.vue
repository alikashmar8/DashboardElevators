<template>
    <div>
        <div class="row mt-3 mb-4">
            <div class="col-md-8">
                <h2>Elevators Available:</h2>
            </div>
            <div class="col-md-4">
                <a href="/elevators/create" class="btn btn-info">Create New Elevator</a>
            </div>
        </div>

        <ol>
            <div v-for="elevator in this.elevators">

                <div class="row">
                    <li></li>
                    <div class="col-md-8">
                        <h4><span class="font-weight-bold mr-3">Elevator Name:</span> <a
                            :href="showModelUrl(elevator.id)">{{elevator.name}}</a></h4>
                        <div v-if="elevator.building != null">
                            <h6 class="font-weight-bold">Is at building:</h6>
                            <p>{{elevator.building.name}}</p>
                        </div>
                        <div v-else>Not Located in any building</div>
                    </div>
                    <div class="col-md-4">
                        <a :href="getEditUrl(elevator.id)" class="btn btn-secondary mx-3">Edit</a>
                        <button class="btn btn-danger" @click.prevent="changeId(elevator.id)" data-target="#deleteModal"
                                data-toggle="modal">Delete
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
                    <input type="hidden" name="deleteId" id="deleteId">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <input type="submit" class="btn btn-danger" value="Delete"
                               @click.prevent="deleteElevator()">
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['elevators'],
        name: "Elevators-Component.vue",
        data() {
            return {
                id: 0,
            }
        },
        methods: {
            getEditUrl(id) {
                return "/elevators/" + id + "/edit";
            },
            showModelUrl(id) {
                return "/elevators/" + id;
            },
            changeId(param) {
                this.id = param;
            },
            deleteElevator() {
                axios.delete("/elevators/" + this.id).then(function (response) {
                    console.log(response);
                    window.location.reload();
                }).catch(error => {
                    console.log(error)
                });
            }
        }
    }
</script>

<style scoped>

</style>
