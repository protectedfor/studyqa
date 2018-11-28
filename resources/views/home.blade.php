@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Главная</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(Auth::check())
                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('home') }}" method="post">
                                {!! csrf_field() !!}
                                <div class="mb-3">
                                    <textarea class="form-control @if($errors->first('text')) is-invalid @endif" style="width: 100%;" name="text" id="" cols="30" rows="10">{{ old('text') ? old('text') : ($homeText ? $homeText->text : '') }}</textarea>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('text') }}
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </form>
                        @else
                            {!! nl2br($homeText ? $homeText->text: '') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
