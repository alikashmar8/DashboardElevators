@extends("layouts.app")

@section('content')

    <Managers-Relations-Component :manager="{{$manager}}" :buildings="{{$buildings}}"
                                  :buildings_id="{{json_encode($buildings_id)}}"></Managers-Relations-Component>

@endsection
