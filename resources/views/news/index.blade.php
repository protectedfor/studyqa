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
                <h4>Новости</h4>
                @if(Auth::check())
                    <a href="{{ route('news.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Добавить новость</a>
                @endif
                @forelse($news as $new)
                    <div class="card mb-3">
                        <div class="card-header"><a href="{{ route('news.show', $new->id) }}">{{ $new->title }}</a>
                            @if(Auth::check())
                                <a href="" class="float-right removeNews" data-toggle="tooltip" data-placement="top" title="Удалить">
                                    <i class="fas fa-eraser"></i>
                                </a>
                                <form action="{{ route('news.destroy', $new->id) }}" method="POST" style="display: none;">
                                    {!! method_field('DELETE') !!}
                                    {!! csrf_field() !!}
                                </form>
                                <a href="{{ route('news.edit', $new->id) }}" class="float-right" data-toggle="tooltip" data-placement="top" title="Редактировать">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            {{ str_limit($new->body, 300) }}
                            <p class="card-text">
                                <small class="text-muted">Опубликовано: {{ $new->created_at->format('d.m.Y H:i') }}, {{ $new->author }} </small>
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info" role="alert">
                        Новостей не найдено!
                    </div>
                @endforelse
                {!! $news->render() !!}
            </div>
        </div>
    </div>
@endsection
