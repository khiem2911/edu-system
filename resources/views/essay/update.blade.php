@extends('layouts.main')
@section('content')
<div class="card" style="margin:20px;">
    <div class="card-header">
       <h4>Edit Essay</h4>
    </div>
    <div class="card-body">
        <form action="{{route("updateEssay",$data->id)}}" method="POST">
            {{ csrf_field() }}
            <label for="">Name</label><br>
            <input value="{{$data->name}}" type="text" name="name" id="" class="form-control">
            <label for="">Address</label><br>
            <input value="{{$data->address}}" type="text" name="address"  class="form-control">            
            <label for="">Essay Title</label><br>
            <input value="{{$data->essaytitle}}" type="text" name="essaytitle"  class="form-control">
            <label for="">Content</label><br>
            <input value="{{$data->content}}" type="text" name="content"  class="form-control"> 
            <button type="submit" class="btn btn-primary">Save</button>
      
           
        </form>
    </div>
</div>
@endsection

           