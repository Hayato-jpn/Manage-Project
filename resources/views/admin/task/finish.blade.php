@extends('layouts.admin')
@section('title', '完了タスク一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>完了タスク一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\TaskController@index') }}" role="button" class="btn btn-primary">未完了タスクへ</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\TaskController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">担当者</th>
                                <th width="15%">〆切</th>
                                <th width="20%">タイトル</th>
                                <th width="30%">本文</th>
                                <th width="10%">編集</th>
                                <th width="10%">変更</th>
                                <th width="10%">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $task)
                                <tr>
                                    <td>{{ \Str::limit($task->person, 100) }}</td>
                                    <td>{{ \Str::limit($task->deadline, 100) }}</td>
                                    <td>{{ \Str::limit($task->title, 100) }}</td>
                                    <td>{{ \Str::limit($task->body, 250) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\TaskController@edit', ['id' => $task->id]) }}">編集</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\TaskController@renew', ['id' => $task->id]) }}">未完了へ</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\TaskController@delete', ['id' => $task->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection