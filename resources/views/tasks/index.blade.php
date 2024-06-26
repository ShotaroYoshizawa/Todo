@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ</div>
          <div class="panel-body">
            <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
              フォルダを追加
            </a>
          </div>
          <div class="list-group">
            
            <table class="table foler-table">
            <thead>
              <tr>
                <th>現在のフォルダ</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($folders as $folder)
              <tr class = "folder-lists {{ $current_folder_id !== $folder->id ? 'no-active' : '' }}">
                <td>
                  <a href="{{ route('tasks.index', ['id' => $folder->id]) }}"
                    class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}"
                    >
                    {{ $folder->title }}
                  </a>
                </td>
                <td><a href="{{ route('folders.edit', ['id' => $folder->id]) }}">編集</a></td>
                <td><a href="{{ route('folders.delete', ['id' => $folder->id]) }}">削除</a></td>
              </tr>
              @endforeach
            </tbody>
            </table>
            <table class="table foler-table">
            <thead>
              <tr>
                <th>その他のフォルダ</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($folders as $folder)
              <tr class = "folder-lists {{ $current_folder_id === $folder->id ? 'active' : '' }}">
                <td>
                  <a href="{{ route('tasks.index', ['id' => $folder->id]) }}"
                    class="list-group-item"
                  >
                    {{ $folder->title }}
                  </a>
                </td>
                <td><a href="{{ route('folders.edit', ['id' => $folder->id]) }}">編集</a></td>
                <td><a href="{{ route('folders.delete', ['id' => $folder->id]) }}">削除</a></td>
              </tr>
              @endforeach
            </tbody>
            </table>
          </div>
        </nav>
      </div>

      <div class="column col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">タスク</div>
          <div class="panel-body">
            <div class="text-right">
              <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="btn btn-default btn-block">
                タスクを追加
              </a>
            </div>
          </div>
          <table class="table">
            <thead>
            <tr>
              <th>タイトル</th>
              <th>状態</th>
              <th>期限</th>
              <th></th>
              <th></th>
              <th>作成日時</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
              <tr>
                <td>{{ $task->title }}</td>
                <td>
                  <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                </td>
                <td>{{ $task->formatted_due_date }}</td>
                <td><a href="{{ route('tasks.edit', ['id' => $current_folder_id, 'task_id' => $task->id]) }}">編集</a></td>
                <td><a href="{{ route('tasks.delete', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">削除</a></td>
                <td>{{ $task->created_at }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection