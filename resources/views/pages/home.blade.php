@extends('layouts.app')

@section('content')
    <div class="page-title">
        <h1>Apaszki</h1>
    </div>

    <div class="page-container">
        @if(empty($scarves) === false)
            <div class="scarves">
                @foreach($scarves as $scarf)
                    <a class="link scarves-item" href="{{ route('scarves.show', $scarf)}}">
                        <div class="image">
                            @foreach($scarf->images()->where(['main_image' => true])->get() as $image)
                                @if ($loop->first)
                                    <img src="{{$image->path}}" alt="{{$image->name}}" width="600" height="600">
                                @else
                                    @break
                                @endif
                            @endforeach
                            @if($scarf->sold_out)
                                <div class="scarf-sold-out">Wyprzedane</div>
                            @endif
                        </div>
                        <div class="title">
                            <h2>{{$scarf->name}}</h2>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection