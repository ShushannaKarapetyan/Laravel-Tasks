@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table class="table table-dark table-hover table-striped">
                    @if(!count($tasks))
                        <h1>No Tasks Found</h1>
                    @else
                        <h1>Tasks</h1>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Task</th>
                            <th scope="col">Description</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks  as $key => $task)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $task->title }}</td>
                                <td>{{\Illuminate\Support\Str::limit($task->description, 20, $end='...') }}</td>
                                <td>
                                    <img src="{{asset('storage/img')}}/{{$task->photo}}" id="img" width="150px" height="100px">
                                </td>
                                <td>{{ $task->status->status_name }}</td>
                                <td><a href="{{url('admin/tasks/'.$task->id.'/edit')}}" class="btn btn-primary">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    @endif

                </table>

            </div>
        </div>
    </div>
@endsection