@extends("layouts.app")

@section('content')

    <Buildings-Component :buildings="{{$buildings}}"></Buildings-Component>

@endsection
