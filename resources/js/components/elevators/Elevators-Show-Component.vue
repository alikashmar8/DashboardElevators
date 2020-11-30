<template>
    <div>
        <H3 class="m-3 font-weight-bold">Elevator Details:</H3>
        <h4 class="m-4"><span class="font-weight-bold">Name:</span> {{elevator.name}}</h4>
        <hr>
        <h4 class="m-4"><span class="font-weight-bold">Index:</span> {{elevator.index}}</h4>
        <hr>
        <h4 class="m-4 font-weight-bold">Located At building:</h4>
        <h5 class="m-4 ml-5 ">Name: {{elevator.building.name}}</h5>
        <h5 class="m-4 ml-5">Address: {{elevator.building.address}}</h5>
    </div>

</template>

<script>
    export default {
        props: ['elevator'],
        name: "Elevators-Show-Component"
    }
</script>

