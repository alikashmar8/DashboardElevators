<template>
    <div>
        <div class="row mt-3 mb-4">
            <div class="col-md-9">
                <h2>Managers Available:</h2>
            </div>
            <div class="col-md-3">
                <a href="/managers/create" class="btn btn-info">Create New Manager</a>
            </div>
        </div>

        <ol>
            <div v-for="manager in this.managers">
                <div class="row m-5">
                    <li></li>
                    <div class="col-md-2">
                        <img :src="getProfileImage(manager.profilePicture)" alt="noImage"
                             style="max-width: 100%;max-height: 100%;">
                    </div>
                    <div class="col-md-6">
                        <h4><span class="font-weight-bold mr-3">Manager Name:</span> {{manager.name}}</h4>
                        <div v-if="manager.buildings.length > 0">
                            <h6 class="font-weight-bold">Buildings he manages:</h6>
                            <ul>
                                <li v-for="building in manager.buildings">{{building.name}}</li>
                            </ul>
                        </div>
                        <div v-else>
                            <h5 class="text-secondary">He does not manage any building</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a :href="getEditUrl(manager.id)" class="btn btn-secondary mx-3">Edit</a>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                @click.prevent="changeId(manager.id)">Delete
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
                               @click.prevent="deleteManager()">
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['managers'],
        name: "Managers-Component.vue",
        data() {
            return {
                id: 0,
            }
        },
        methods: {
            getProfileImage(url) {
                return 'storage/profile_images/' + url;
            },
            changeId(param) {
                this.id = param;
            },
            getEditUrl(id) {
                return "/managers/" + id + "/edit";
            },
            deleteManager() {
                axios.delete('/managers/' + this.id).then(function (response) {
                    if (response.status === 200) {
                        console.log("success");
                        window.location.reload();
                    }
                }).catch(error => {
                    console.log("Error = " + error);
                });
            }
        }
    }
</script>

<style scoped>

</style>
