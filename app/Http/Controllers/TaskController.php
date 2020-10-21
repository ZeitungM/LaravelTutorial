<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\CreateTask;
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
}
