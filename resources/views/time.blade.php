@extends('layout')
@section('title','Task')
@section('content')
<div class="card">
@include('nav')
<div class="row mx-5 my-4">
    </div>
    <div class="card-header">Time Entry List
    <span class="float-right"><button type="button" class="btn btn-primary " data-toggle="modal"
            data-target="#exampleModal"> Add Time Entry</button></span> </div>
            <div class="card-body">
            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Project Name</th>
                <th scope="col">Task Name</th>
                <th scope="col">Hours</th>
                <th scope="col">Date</th>
                <th scope="col">Description</th>

                </tr>
                </thead>
                <tbody>
                @if($time_entries->isNotEmpty())
                @foreach($time_entries as $key =>$time)
                <tr>
                <th>{{isset($key)?($key+1):''}}</th>
                <td>{{$time->task->project?$time->task->project->name:''}}</td>
                <td>{{$time->task?$time->task->name:''}}</td>
                <td>{{date('H:i',strtotime($time['hours']??0))}}</td>
                <td>{{date('d-m-Y',strtotime($time['entry_date']??0))}}</td>
                <td>{{$time['description']??''}}</td>

                </tr>
                @endforeach
                @else

                <tr class="text-center"><td colspan="6">Empty</td></tr>

                @endif

                </tbody>
                </table>
                </div>
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

            <form method="post" action="{{route('time.store')}}">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Task</label>
                        <select class="form-control" name="task" placeholder="Select Task" required>
                            <option value=''></option>
                            @foreach($tasks as $task)
                            <option value="{{$task->id??''}}">{{$task->name??''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Date</label>
                        <input type="date" class="form-control" placeholder="Date" name="date" maxlength="50" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Hours</label>
                        <input type="time" class="form-control" placeholder="Hours" name="hours" maxlength="50"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="" cols="30" rows="10" maxlength="250"
                            required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection