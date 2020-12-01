<template>
    <div>
        <H3 class="m-3 font-weight-bold">Manager Details:</H3>
        <div class="row">
            <div class="col-md-8"><h4 class="m-4"><span class="font-weight-bold">Name:</span> {{manager.name}}</h4>
                <hr>
                <h4 class="m-4"><span class="font-weight-bold">Address:</span> {{manager.address}}</h4>
                <hr>
                <h4 class="m-4"><span class="font-weight-bold">Phone Number:</span> {{manager.phoneNumber}}</h4>
                <hr>

                <div v-if="manager.buildings.length > 0">
                    <h4 class="font-weight-bold mt-4 ml-4">Manager Building:</h4>
                    <ul>
                        <li v-for="building in manager.buildings">{{building.name}}</li>
                    </ul>
                </div>
                <div v-else>
                    <h5 class="text-secondary">He does not manage any building!</h5>
                </div>
            </div>
            <div class="col-md-2"><img :src="getImageSrc()" style="width: 250px; height: 250px;"></div>
        </div>


    </div>

</template>

<script>
    export default {
        props: ['manager'],
        name: "Managers-Show-Component.vue",
        methods: {
            getImageSrc() {
                return '/storage/profile_images/' + this.manager.profilePicture;
            },
        }
    }
</script>
