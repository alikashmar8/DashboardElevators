@extends("layouts.app")

@section('content')

    <Buildings-Show-Component :building="{{$building}}"></Buildings-Show-Component>

@endsection
