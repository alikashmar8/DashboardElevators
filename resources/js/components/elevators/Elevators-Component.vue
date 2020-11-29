<template>
    <div>
        <div v-for="elevator in this.elevators">
            <hr>
            <h4>Elevator Name: {{elevator.name}}</h4>
            <div v-if="elevator.building != null">
                <h5>Is at building:</h5>
                <h6>{{elevator.building.name}}</h6>
            </div>
            <div v-else>Not Located in any building</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['elevators'],
        name: "Elevators-Component.vue"
    }
</script>

<style scoped>

</style>
