<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Folder;
use App\Models\Company;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;

class TaskController extends Controller
{
    public function admin_index(int $id)
    {
      //すべてのフォルダを取得する
      $folders = Folder::all();

      //選ばれたフォルダを取得する
      $current_folder = Folder::find($id);

      //選ばれたフォルダに紐づくタスクを取得する
      $tasks = $current_folder->tasks()->get();

      return view('admin/tasks/index',[
        'folders' => $folders,
        'current_folder' => $current_folder,
        'current_folder_id' => $current_folder->$id,
        'tasks' => $tasks,
      ]);
    }
    /**
     * GET /admin/folders/{id}/tasks/create
     */
    public function showCreateForm(int $id)
    {
      return view('admin/tasks/create',[
        'folder_id' => $id
      ]);
    }
    /**
     * GET /admin/folders/{id}/tasks/{tasks_id}/edit
     */
    public function showEditForm(int $id,int $task_id)
    {
      $task = Task::find($task_id);

      return view('admin/tasks/edit',[
        'task' => $task,
      ]);
    }

    public function edit(int $id, int $task_id, EditTask $request)
    {
      $task = Task::find($task_id);

      $task->title = $request->title;
      $task->status = $request->status;
      $task->due_date = $request->due_date;
      $task->save();

      return redirect()->route('admin.tasks.index',[
        'id' => $task->folder_id,
      ]);
    }

    public function create(int $id,CreateTask $request)
    {
      $current_folder = Folder::find($id);

      $task = new Task();
      $task->title = $request->title;
      $task->due_date = $request->due_date;

      $current_folder->tasks()->save($task);

      return redirect()->route('admin.tasks.index',[
        'id' => $current_folder->id,
      ]);
    }

    /**
     * 法人用
     */
    public function company_index(int $id)
    {
      $company_tasks = Task::find($id);

      //選ばれたフォルダに紐づくタスクを取得する
      $tasks = Task::where('company_id', $company_tasks->id)->get();
      
      
      return view('company/tasks/index',[
        'folders' => $folders,
        'current_folder_id' => $current_folder->$id,
        'tasks' => $tasks,
      ]);
    }
}
