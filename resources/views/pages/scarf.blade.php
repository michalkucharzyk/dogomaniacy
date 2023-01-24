@extends('layouts.app')
@section('title', ' - '.$scarf->name)
@section('content')
    <div class="page-container no-title">
        <div class="scarf-details">
            <div class="scarf-images">
                <image-sliders :images-list="{{json_encode($images)}}"></image-sliders>
            </div>
            <div class="scarf-description">
                <div class="title">
                    <h1>{{$scarf->name}}</h1>
                    @if((bool) $scarf->sold_out === true)
                        <div class="scarf-sold-out">Wyprzedane</div>
                    @endif
                </div>
                <div class="description">{{$scarf->description}}</div>
            </div>
            @if (Auth::check())
                <a href="{{route('admin.scarves.edit', $scarf)}}" target="_blank" class="btn btn-warning btn-sm">Edytuj</a>
            @endif
        </div>
    </div>
@endsection