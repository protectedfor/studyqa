@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('news.index') }}" class="btn btn-primary mb-3"><i class="fas fa-backward"></i> К списку новостей</a>
                <h4>{{ $feed->title }}</h4>
                <small class="text-muted">Опубликовано: {{ $feed->created_at->format('d.m.Y H:i') }}, {{ $feed->author }} </small>
                <p class="mt-3">{!! nl2br($feed->body) !!}</p>
            </div>
        </div>
    </div>
@endsection
