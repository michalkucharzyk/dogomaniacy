@extends('layouts.admin')

@section('title', 'Lista apaszek')

@section('content')
    <a href="{{route('admin.scarves.create')}}" class="btn btn-primary">{{__('default.button.add')}}</a>
    <div class="mb-2"></div>
    <scarves-list-admin scarves="{{json_encode($scarves)}}"></scarves-list-admin>


@endsection
