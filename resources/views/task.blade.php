@extends('layout')
@section('title','Task')
@section('content')

<div class="card"> @include('nav') <div class="row mx-5 my-4"> </div> <div class="card-header">Task List
    <span class="float-right"><button type="button" class="btn btn-primary " data-toggle="modal"
        data-target="#exampleModal"> Add Task</button></span>
    </div> <div class="card-body"> <table class="table table-striped table-bordered">
    <thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Project Name</th>
    <th scope="col">Task</th>
    <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>
        @if($tasks->isNotEmpty())
        @foreach($tasks as $key =>$task)
        <tr>
            <th >{{isset($key)?($key+1):''}}</th>
            <td>{{$task->project?$task->project->name:''}}</td>
            <td>{{$task['name']??''}}</td>
            <td>{{ $task['status']?(($task['status']==1)?'Active':'InActive'):''}}</td>
            </tr>
            @endforeach
            @else

        <tr class="text-center">
            <td colspan="4">Empty</td>
            </tr>

            @endif

    </tbody>
    </table>
</div>

<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{route('task.store')}}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Task Name</label>
                        <input type="text" class="form-control" placeholder="Task name" name="name" maxlength="50"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Project</label>
                        <select class="form-control" name="project" placeholder="Select Project" required>
                            <option value=''></option>
                            @foreach($projects as $project)
                            <option value="{{$project->id??''}}">{{$project->name??''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Status</label>
                        <select class="form-control" name="status" placeholder="Select status" required>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
    @endsection