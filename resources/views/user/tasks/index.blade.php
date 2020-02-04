@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <table class="table table-dark table-hover table-striped">
                    @if(!count($myTasks))
                        <h1>No Created Tasks Found</h1>
                    @else
                            <h1>My Tasks(iren kcacner@)</h1>
                             <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Task</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Status</th>
                                </tr>
                             </thead>
                            <tbody>
                                @foreach($myTasks  as $key => $myTask)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $myTask->title }}</td>
                                        <td>{{\Illuminate\Support\Str::limit($myTask->description, 20, $end='...') }}</td>
                                        <td>
                                            <img src="{{asset('storage/img')}}/{{$myTask -> photo}}" id="img" width="150" height="100">
                                        </td>
                                        <td>{{ $myTask->status->status_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                    @endif

                </table>



                <table class="table table-dark table-hover table-striped">

                    @if(!count($attachedTasks))
                        <h1>No Attached Tasks Found</h1>
                    @else
                        <h1>Attached Tasks(ir kcacner@ iren kam urishin)</h1>
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
                            @foreach($attachedTasks  as $key => $attachedTask)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $attachedTask->title }}</td>
                                    <td>{{\Illuminate\Support\Str::limit($attachedTask->description, 20, $end='...') }}</td>
                                    <td>
                                        <img src="{{asset('storage/img')}}/{{$attachedTask -> photo}}" id="img" width="150px" height="100px">
                                    </td>
                                    <td>{{$attachedTask->status->status_name }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{url('user/tasks/'.$attachedTask->id.'/edit')}}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @endif
                </table>

            </div>
        </div>
    </div>
@endsection