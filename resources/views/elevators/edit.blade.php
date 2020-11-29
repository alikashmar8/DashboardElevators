@extends("layouts.app")

@section('content')

    <Elevators-Edit-Component :buildings="{{$buildings}}" :elevator="{{$elevator}}"></Elevators-Edit-Component>

@endsection
