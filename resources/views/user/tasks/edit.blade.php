@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Task</h1>
        <div class="row">
            <div class="col-md-8">
                <form action="{{route('tasks.update', $task -> id)}}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    {{method_field('PUT')}}


                    <div class="form-group">
                        <input type="text" placeholder="Task Title" value="{{$task->title}}" name='title' class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="text" placeholder="Task Description" value="{{$task->description}}" name='description' class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="photo"></label>
                        <input type="file" name="photo" id="imgInput" accept=".jpg, .jpeg, .png" value="{{ $task -> photo }}"><br>
                        <br>
                        <img src="{{asset('storage/img')}}/{{$task -> photo}}" id="img" width="150px" height="100px">

                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status">
                            @foreach($statuses as $status)
                                <option value="{{ $status -> id }}"
                                        @if($status -> id == $task->status->id)
                                        selected
                                        @endif
                                >{{ $status -> status_name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="user">User</label>

                        <select name="user">
                            <option value=""></option>
                            @foreach($users as $user)
                                <option value="{{ $user -> id }}"
                                            @if($user -> id == $task->to_user)
                                                selected
                                            @endif
                                >{{ $user -> name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>

                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInput").change(function() {
            readURL(this);
        });





    </script>

@endsection