<template>
    <div>
        <div v-for="building in this.buildings">
            <hr>
            <h4>Building Name: {{building.name}}</h4>
            <h5>Building Managers:</h5>
            <ul>
                <li v-for="manager in building.managers">{{manager.name}}</li>
            </ul>
            <h5>Building Elevators:</h5>
            <ul>
                <li v-for="elevator in building.elevators">{{elevator.name}}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['buildings'],
        name: "Buildings-Component.vue",
    }
</script>

