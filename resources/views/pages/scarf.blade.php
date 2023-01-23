@extends('layouts.app')

@section('content')
    <div class="page-container no-title">
        <div class="scarf-details">
            <div class="scarf-images">
                <slides-init :slides-list="{{json_encode($slides)}}"></slides-init>
            </div>
            <div class="scarf-description">
                <div class="title"><h1>{{$scarf->name}}</h1></div>
                <div class="description">{{$scarf->description}}</div>
            </div>
        </div>
    </div>
@endsection