@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Task</h1>
        <div class="row">
            <div class="col-md-8">
                <form action="{{ action('TaskController@store') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="text" placeholder="Task Title" name='title' class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="text" placeholder="Task Description" name='description' class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="photo"></label>
                        <input type="file" name="photo" id="imgInput">
                        <br>
                        <img src="" alt="" id="img" width="200" height="150">
                    </div>

                    <div class="form-group">
                        <label for="user">User</label>
                        <select name="user">
                            <option value=""></option>
                            @foreach($users as $user)
                                <option value="{{  $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                    
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