@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4>@if(isset($feed)) Редактирование новости #{{ $feed->id }} @else Создание новости @endif</h4>
                <a href="{{ route('news.index') }}" class="btn btn-primary mb-3"><i class="fas fa-backward"></i> К списку новостей</a>

                <form action="{{ isset($feed) ? route('news.update', $feed->id) : route('news.store') }}" method="post">
                    {!! csrf_field() !!}
                    @if(isset($feed))
                        {!! method_field('PUT') !!}
                    @endif
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" name="title" value="{{ old('title') ? old('title') : (isset($feed) ? $feed->title : '') }}" class="form-control @if($errors->first('title')) is-invalid @endif" id="title" aria-describedby="title" placeholder="Введите заголовок">
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="body">Текст</label>
                        <textarea rows="10" type="text" name="body" class="form-control @if($errors->first('body')) is-invalid @endif" id="body" placeholder="Введите текст новости">{{ old('body') ? old('body') : (isset($feed) ? $feed->body : '') }}</textarea>
                        <div class="invalid-feedback">
                            {{ $errors->first('body') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="author">Автор</label>
                        <input type="text" name="author" value="{{ old('author') ? old('author') : (isset($feed) ? $feed->author : '') }}" class="form-control  @if($errors->first('author')) is-invalid @endif" id="author" aria-describedby="author" placeholder="Введите имя автора">
                        <div class="invalid-feedback">
                            {{ $errors->first('author') }}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">@if(isset($feed)) Редактировать @else Добавить @endif</button>
                    <a href="{{ route('news.index') }}" class="btn btn-warning float-right">Отмена</a>
                </form>
            </div>
        </div>
    </div>
@endsection
