@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                            <!-- New Task Form -->
                    <form action="/task" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                                <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task : </label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>
                        <!-- Task Type -->
                        <div class="form-group">
                            <label for="task-type" class="col-sm-3 control-label">Type : </label>

                            <div class="col-sm-6">
                                <input type="text" name="type" id="task-type" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>

                        <!-- Task Co workers  -->
                        <div class="form-group">
                            <label for="task-co_workers" class="col-sm-3 control-label">Co-workers : </label>

                            <div class="col-sm-6">
                                <input type="text" name="co_workers" id="task-co_workers" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>


                        <!-- Task Start time -->
                        <div class="form-group">
                            <label for="task-start_time" class="col-sm-3 control-label">Start time : </label>
                            <div class="col-sm-8">
                                <div class="container-fluid">
                                    <div class="col-sm-6">
                                        <label for="task-start_time_year" class="col-sm-3 control-label">Year</label>
                                        <input type="number" class="form-control" max="2030" min="2000" name="year" id="task-start_time_year"  value="2016">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="task-start_time_month" class="col-sm-3 control-label">Month</label>
                                        <input type="number" max="12" min="1" name="month" id="task-start_time_month" class="form-control" value="3">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="task-start_time_day" class="col-sm-3 control-label">Day</label>
                                        <input type="number" max="31" min="1" name="day" id="task-start_time_day" class="form-control" value="15">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Task time estimation  -->
                        <div class="form-group">
                            <label for="task-time_estimation" class="col-sm-3 control-label">Time estimation (day) : </label>

                            <div class="col-sm-3">
                                <input type="number" min="0" name="time_estimation" id="task-time_estimation" class="form-control">
                            </div>

                        </div>



                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Todo Tasks
                    </div>

                    <div class="panel-body table-responsive">

                        <table class="table task-table">
                            <thead>
                            <th>Task</th>
                            <th>state</th>
                            <th>start_time</th>
                            <th>day_estimation</th>
                            <th>co_workers</th>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                                @if($task->state == 0)
                                    {{-- todo table --}}
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <a href="/task_done/{{ $task->id }}" class="btn btn-success">
                                                <i class="fa fa-btn fa-check-square-o"></i>Done</a>
                                            <a href="/task_doing/{{ $task->id }}" class="btn btn-success">
                                                <i class="fa fa-btn fa-refresh"></i>Doing</a>
                                            <a href="/delete_task/{{ $task->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Delete</a>

                                        </td>
                                        <td class="table-text"><div>{{ $task->start_date }}</div></td>
                                        <td class="table-text"><div>{{ $task->day_estimation }}</div></td>
                                        <td class="table-text"><div>{{ $task->co_worker }}</div></td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Doing Tasks
                    </div>

                    <div class="panel-body table-responsive">
                        <table class="table task-table">
                            <thead>
                            <th>Task</th>
                            <th>state</th>
                            <th>start_time</th>
                            <th>day_estimation</th>
                            <th>co_workers</th>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                                @if($task->state == 1)
                                    {{-- doing table --}}
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <a href="/task_done/{{ $task->id }}" class="btn btn-success">
                                                <i class="fa fa-btn fa-check-square-o"></i>Done</a>
                                            <a href="/task_todo/{{ $task->id }}" class="btn btn-success">
                                                <i class="fa fa-btn fa-share"></i>Todo</a>
                                            <a href="/delete_task/{{ $task->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Delete</a>

                                        </td>
                                        <td class="table-text"><div>{{ $task->start_date }}</div></td>
                                        <td class="table-text"><div>{{ $task->day_estimation }}</div></td>
                                        <td class="table-text"><div>{{ $task->co_worker }}</div></td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Done Tasks
                    </div>

                    <div class="panel-body table-responsive">
                        <table class="table task-table">
                            <thead>
                            <th>Task</th>
                            <th>state</th>
                            <th>start_time</th>
                            <th>day_estimation</th>
                            <th>co_workers</th>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                                @if($task->state == 2)
                                    {{-- done table --}}
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <a href="/task_todo/{{ $task->id }}" class="btn btn-success">
                                                <i class="fa fa-btn fa-share"></i>Todo</a>
                                            <a href="/task_doing/{{ $task->id }}" class="btn btn-success">
                                                <i class="fa fa-btn fa-refresh"></i>Doing</a>
                                            <a href="/delete_task/{{ $task->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Delete</a>
                                        </td>
                                        <td class="table-text"><div>{{ $task->start_date }}</div></td>
                                        <td class="table-text"><div>{{ $task->day_estimation }}</div></td>
                                        <td class="table-text"><div>{{ $task->co_worker }}</div></td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
