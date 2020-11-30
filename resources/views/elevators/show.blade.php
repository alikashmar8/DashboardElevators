@extends("layouts.app")

@section('content')

    <Elevators-Show-Component :elevator="{{$elevator}}"></Elevators-Show-Component>

@endsection
