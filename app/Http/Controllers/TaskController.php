<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use App\Repositories\TaskRepository;
use DB;
class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    public function ehsan($id)
    {
        echo "ehsan" + $id;
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $date = "";
        $date = $request->year . "/" . $request->month . "/" . $request->day;
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
            'state' => '0',
            'type' => $request->type,
            'co_worker' => $request->co_workers,
            'day_estimation' => $request->time_estimation,
            'start_date' => $date
        ]);

        return redirect('/tasks');
    }

    /**
     * Destroy the given task.
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

    /**
     * when the done button is clicked it goes to done tasks.
     *
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function task_done(Request $request, Task $task){
        $task->state = '2';
        $task->save();

        return redirect('/tasks');
    }

    /**
     * when the done button is clicked it goes to done tasks.
     *
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function task_todo(Request $request, Task $task){
        $task->state = '0';
        $task->save();

        return redirect('/tasks');
    }

    public function task_doing(Request $request, Task $task){
        $task->state = '1';
        $task->save();

        return redirect('/tasks');
    }
}
