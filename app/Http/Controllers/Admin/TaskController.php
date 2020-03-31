<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\History;
use Carbon\Carbon;

class TaskController extends Controller
{
    //
    public function add() {
        return view('admin.task.create');
    }
    
    public function create(Request $request) {
        // Varidationを行う
        $this->validate($request, Task::$rules);
        
        $user_id = Auth::id();
        $task = new Task;
        $form = $request->all();
        $form += ["status" => 'working'];
        $form += ["user_id" => $user_id];
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);

        // データベースに保存する
        $task->fill($form);
        $task->save();
        
        return redirect('admin/task');
    }
    
    public function index(Request $request) {
        $user_id = Auth::id();
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Task::where('user_id', $user_id)->where('title', 'like', "%{$cond_title}%")->where('status', 'working')->orderby('person', 'asc')->orderby('deadline', 'asc')->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Task::where('user_id', $user_id)->where('status', 'working')->orderby('person', 'asc')->orderby('deadline', 'asc')->get();
        }
        
        return view('admin.task.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function edit(Request $request)
  {
        // News Modelからデータを取得する
        $task = Task::find($request->id);
        if (empty($task)) {
          abort(404);    
        }
        
        return view('admin.task.edit', ['task_form' => $task]);
  }


    public function update(Request $request)
  {
        // Validationをかける
        $this->validate($request, Task::$rules);
        // News Modelからデータを取得する
        $task = Task::find($request->id);
        // 送信されてきたフォームデータを格納する
        $task_form = $request->all();
        unset($task_form['_token']);

        // 該当するデータを上書きして保存する
        $task->fill($task_form)->save();
        
        // 以下を追記
        $history = new History;
        $history->task_id = $task->id;
        $history->edited_at = Carbon::now();
        $history->save();

        return redirect('admin/task');
  }
  
    public function delete(Request $request) {
        // 該当するNews Modelを取得
        $task = Task::find($request->id);
        // 削除する
        $task->delete();
        
        return redirect('admin/task');
  }
  
    public function finish(Request $request) {
        $user_id = Auth::id();
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Task::where('user_id', $user_id)->where('title', 'like', "%{$cond_title}%")->where('status', 'done')->orderby('person', 'asc')->orderby('deadline', 'asc')->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Task::where('user_id', $user_id)->where('status', 'done')->orderby('person', 'asc')->orderby('deadline', 'asc')->get();
        }
        
        return view('admin.task.finish', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  
    public function renew(Request $request) {
        // 該当するNews Modelを取得
        $task = Task::find($request->id);
        // 削除する
        $task->status = "working";
        $task->save();
        
        return redirect('admin/task/finish');
  }
  
    public function done(Request $request) {
        // 該当するNews Modelを取得
        $task = Task::find($request->id);
        // 削除する
        $task->status = "done";
        $task->save();
        
        return redirect('admin/task');
  }
}
