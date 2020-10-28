<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index(int $id)
    {
        $folders = Folder::all();
        $current_folder = Folder::find($id);

        $tasks = $current_folder->tasks()->get();

        return view('tasks/index', [ 'folders'           => $folders,
                                     'current_folder_id' => $current_folder->id,
                                     'tasks'             => $tasks, ] );
    }

    public function showCreateForm(int $folder_id)
    {
        return view( 'tasks/create', [ 'folder_id' => $folder_id ] );
    }

    public function showEditForm(int $folder_id, int $task_id)
    {
        $task = Task::find($task_id);

        return view( 'tasks/edit', [ 'task'   => $task    ] );
    }

    public function create(int $folder_id, CreateTask $request)
    {
        $current_folder = Folder::find($folder_id);
        
        $task           = new Task();
        $task->title    = $request->title;
        $task->due_date = $request->due_date;
        
        $current_folder->tasks()->save($task);
        
        return redirect()->route( 'tasks.index', ['id'=>$current_folder->id, ] );
    }

    public function edit(int $folder_id, int $task_id, EditTask $request)
    {
        $current_task = Task::find($task_id);
 
        $current_task->title    = $request->title;
        $current_task->status   = $request->status;
        $current_task->due_date = $request->due_date;
        
        $current_task->save();
        
        return redirect()->route( 'task.index', [ 'id'=>$current_task->folder_id, ] );
    }
}
