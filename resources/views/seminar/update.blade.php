@extends('layouts.main')
@section('content')
<div class="card" style="margin:20px;">
    <div class="card-header">
       <h4>Edit Seminar</h4>
    </div>
    <div class="card-body">
        <form action="{{route("updateSeminar",$data->id)}}" method="POST">
            {{ csrf_field() }}
            <label for="">Name</label><br>
            <input value="{{$data->name}}" type="text" name="name" id="" class="form-control">
            <label for="">Content</label><br>
            <input value="{{$data->content}}" type="text" name="content"  class="form-control">
            <label for="">Time start</label><br>
            <input value="{{$data->timestart}}" type="datetime-local" name="timestart" id="" class="form-control">
            <label for="">Time end</label><br>
            <input value="{{$data->timeend}}" type="datetime-local" name="timeend" id="" class="form-control"><br>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection

           