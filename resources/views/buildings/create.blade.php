@extends("layouts.app")

@section('content')

    <div class="title m-b-md">
        Create Building:
    </div>
    <div class="alert alert-danger" role="alert" v-bind:class="{hidden: hasError}">
        All fields are required!
    </div>
    <div class="form-group">
        <label for="name">Building Name</label>
        <input type="text" class="form-control" id="name" required placeholder="Name" name="name"
               v-model="newBuilding.name">
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" required placeholder="Address" name="address"
               v-model="newBuilding.address">
    </div>
    <div class="form-group">
        <label for="floors">Floors</label>
        <input type="number" class="form-control" id="floors" required placeholder="Floors" name="floors"
               v-model="newBuilding.floors   ">
    </div>

    <div class="form-group">
        <label for="contactNumber">Contact Number</label>
        <input type="text" class="form-control" id="contactNumber" required placeholder="contactNumber"
               name="contactNumber" v-model="newBuilding.contactNumber">
    </div>

    <button class="btn btn-primary" @click.prevent="createBuilding()">
        Add Building
    </button>
@endsection
