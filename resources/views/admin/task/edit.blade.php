@extends('layouts.admin')
@section('title', 'タスク編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>タスク編集</h2>
                <form action="{{ action('Admin\TaskController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="title">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $task_form->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="10">{{ $task_form->body }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">〆切</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="deadline" value="{{ $task_form->deadline, \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">作業担当者</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="person" value="{{ $task_form->person }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">更新者</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="changer" value="{{ old('changer') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $task_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($task_form->histories != NULL)
                                @foreach ($task_form->histories as $history)
                                    <li class="list-group-item">更新者：{{ $history->changer }}</li>
                                    <li class="list-group-item">{{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection