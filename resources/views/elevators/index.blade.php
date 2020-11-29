@extends("layouts.app")

@section('content')

    <Elevators-Component :elevators="{{$elevators}}"></Elevators-Component>

@endsection
