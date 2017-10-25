<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $tasks;

    /**
     * 建立新的任務。
     *
     * @param  Request  $request
     * @return Response
     */
    public function __construct()
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);


        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    /**
     * 顯示使用者所有任務的清單。
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', $request->user()->id)->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }
}
/**
 * Display a list of all of the user's task.
 *
 * @param  Request  $request
 * @return Response
 */
public function index(Request $request)
{
    $tasks = Task::where('user_id', $request->user()->id)->get();

    return view('tasks.index', [
        'tasks' => $tasks,
    ]);
}


