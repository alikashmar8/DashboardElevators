<template>
    <div>
        <H3 class="m-3 font-weight-bold">Building Details:</H3>
        <h4 class="m-4"><span class="font-weight-bold">Name:</span> {{building.name}}</h4>
        <hr>
        <h4 class="m-4"><span class="font-weight-bold">Address:</span> {{building.address}}</h4>
        <hr>
        <h4 class="m-4"><span class="font-weight-bold">Floors:</span> {{building.floors}}</h4>
        <hr>
        <h4 class="m-4"><span class="font-weight-bold">Contact Number:</span> {{building.contactNumber}}</h4>
        <hr>

        <div v-if="building.managers.length > 0">
            <h4 class="font-weight-bold mt-4 ml-4">Building Managers:</h4>
            <ul>
                <li v-for="manager in building.managers">{{manager.name}}</li>
            </ul>
        </div>
        <div v-else>
            <h5 class="text-secondary">No managers in this building</h5>
        </div>
        <hr>
        <div v-if="building.elevators.length > 0">
            <h5 class="font-weight-bold mt-4 ml-4">Building Elevators:</h5>
            <ul>
                <li v-for="elevator in building.elevators">{{elevator.name}}</li>
            </ul>
        </div>
        <div v-else>
            <h5 class="text-secondary">No elevators in this building</h5>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['building'],
        name: "Buildings-Show-Component.vue"
    }
</script>
