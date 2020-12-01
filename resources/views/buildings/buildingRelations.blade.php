@extends("layouts.app")

@section('content')

    <Buildings-Relations-Component :building="{{$building}}" :managers="{{$managers}}"
                                   :managers_id="{{json_encode($managers_id)}}"></Buildings-Relations-Component>

@endsection
