@extends('layouts.admin')

@section('title', 'Dodaj nową apaszkę')

@section('content')
    <form method="POST" action="{{$route}}" enctype="multipart/form-data">
        @csrf
        @if ($type === 'edit')
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="nameScarves">{{__('scarves.label.name')}}</label>
            <input type="text" name="name" class="form-control" id="nameScarves"
                   placeholder="{{__('scarves.label.name_placeholder')}}"
                   @if(isset ($scarf->name)) value="{{$scarf->name}}"
                   @endif>
        </div>
        <div class="mb-2"></div>
        <div class="form-group">
            <label for="descriptionScarves">{{__('scarves.label.description')}}</label>
            <textarea class="form-control" name="description" id="descriptionScarves" rows="5">@if(isset ($scarf->description)){{$scarf->description}}@endif</textarea>
        </div>
        <div class="mb-2"></div>
        <div class="form-group">
            <label for="attachment" class="form-label">{{__('scarves.label.main_image')}}</label>
            @if(isset($scarf->images))
                <div class="flex-wrap-form-image">
                @foreach ($scarf->images as $image)
                    @if ((bool) $image->main_image === true)
                        <image-form-preview :image="{{$image}}"
                                                      :route-delete="'{{route('admin.scarves.destroy.image', ['scarf' => $scarf, 'image' => $image])}}'">
                        </image-form-preview>
                    @endif
                @endforeach
                </div>
            @endif
            <div>
                <input class="form-control" type="file" name="main_image" id="attachment" accept=".png,.img,.jpeg,"
                       @if ($type === 'create')
                           required
                        @endif/>
            </div>
        </div>
        <div class="mb-2"></div>
        <div class="form-group">
            <label for="attachment" class="form-label">{{__('scarves.label.additional_image')}}</label>
            @if(isset($scarf->images))
                <div class="flex-wrap-form-image">
                @foreach ($scarf->images as $image)
                    @if ((bool) $image->main_image === false)
                        <image-form-preview :image="{{$image}}"
                                                      :route-delete="'{{route('admin.scarves.destroy.image', ['scarf' => $scarf, 'image' => $image])}}'">
                        </image-form-preview>
                    @endif
                @endforeach
                </div>
            @endif
            <div>
                <input class="form-control" type="file" name="additional_image[]" id="attachment" multiple
                       accept=".png,.img,.jpeg,"/>
            </div>
        </div>
        <div class="mb-2"></div>
        <div class="form-check form-switch">
            <input class="form-check-input" name="public" type="checkbox" id="public"
                   @if(isset ($scarf->public))
                       @if ((bool) $scarf->public === true)
                           checked
                   @endif
                   @else
                       checked
                    @endif
            >
            <label class="form-check-label" for="public">{{__('scarves.label.public_description')}}</label>
        </div>
        <div class="d-flex flex-row-reverse">
            <div class="p-2">
                <button class="btn btn-secondary">{{__('default.button.save')}}</button>
            </div>
        </div>

    </form>
@endsection