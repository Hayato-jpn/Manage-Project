@extends('layouts.admin')
@section('title', 'タスク新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>タスク新規作成</h2>
                <form action="{{ action('Admin\TaskController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="10">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">〆切</label>
                        <div class="col-md-10">
                            <!--<input type="text" class="form-control" name="deadline" value="{{ old('deadline') }}">-->
                            <input type="date" class="form-control" name="deadline" value="{{ old('deadline', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">担当者</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="person" value="{{ old('person') }}">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="作成">
                </form>
            </div>
        </div>
    </div>
@endsection