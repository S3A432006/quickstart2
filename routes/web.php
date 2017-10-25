<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::auth();
Route::get('/', function () {
    return view('welcome');
});
    Route::get('/tasks', 'TaskController@index');
    Route::post('/task', 'TaskController@store');
    Route::delete('/task/{task}', 'TaskController@destroy');
/**
 * 建立新的任務。
 *
 * @param  Request  $request
 * @return Response
 */
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
/**
 * 移除給定的任務。
 *
 * @param  Request  $request
 * @param  Task  $task
 * @return Response
 */
public function destroy(Request $request, Task $task)
{
    $this->authorize('destroy', $task);

    $task->delete();

    return redirect('/tasks');
}


