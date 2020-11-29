<template>
    <div>
        <div v-for="manager in this.managers">
            <div class="row">
                <div class="col-md-2">
                    <img :src="getProfileImage(manager.profilePicture)" alt="noImage">
                </div>
                <div class="col-md-8">
                    <h4>Manager Name: {{manager.name}}</h4>
                    <div v-if="manager.buildings.length > 0">
                        <h5>Buildings he manages:</h5>
                        <ul>
                            <li v-for="building in manager.buildings">{{building.name}}</li>
                        </ul>
                    </div>
                    <div v-else>
                        <h5>He does not manage any building</h5>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['managers'],
        name: "Managers-Component.vue",
        methods: {
            getProfileImage(url) {
                return 'storage/profile_images/' + url;
            },
        }
    }
</script>

<style scoped>

</style>
