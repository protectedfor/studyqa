@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <h4>Изображения</h4>
                @if(Auth::check())
                    <a href="" class="btn btn-success mb-3 addPicture"><i class="fas fa-plus"></i> Добавить картинку</a>
                    <input type="file" name="image" accept="image/*" class="pictureField" style="display: none;">
                @endif
                <div class="clearfix"></div>
                <div id="animated-thumbnails">
                    @forelse($pictures as $picture)
                        <div class="text-center">
                            <a class="light-picture" href="{{ url($picture->image) }}">
                                <img data-id="{{ $picture->id }}" src="{{ url($picture->image) }}" style="width: 300px;" alt="..." class="img-thumbnail mb-3">
                            </a>
                            <div class="clearfix"></div>
                            @if(Auth::check())
                                <a href="" class="removeImage"><i class="fas fa-eraser fa-2x"></i></a>
                            @endif

                            <form action="{{ route('pictures.destroy', $picture->id) }}" method="POST" style="display: none;">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                            </form>
                        </div>
                    @empty
                        <div class="alert alert-info" role="alert">
                            Изображений не найдено!
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
