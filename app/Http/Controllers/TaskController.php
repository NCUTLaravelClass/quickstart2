<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //

    public function __construct() //建構式 使用者驗證
    {
        $this->middleware('auth');
    }

    public function index()
    {

         $tasks = Task::where('user_id',  Auth::id())->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    public function store(Request $request)
    {


        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    public function destroy(Request $request, Task $task)
    {
        //
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }
}
