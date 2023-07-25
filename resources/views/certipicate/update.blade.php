@extends('layouts.main')
@section('content')
<div class="card" style="margin:20px;">
    <div class="card-header">
       <h4>Edit Certipicate</h4>
    </div>
    <div class="card-body">
        <form action="{{route("updateCertipicate",$data->id)}}" method="POST">
            {{ csrf_field() }}
            <label for="">Name</label><br>
            <input value="{{$data->name}}" type="text" name="name" id="" class="form-control">
            <label for="">Address</label><br>
            <input value="{{$data->address}}" type="text" name="address"  class="form-control">
            <label for="">Date of birth</label><br>
            <input value="{{$data->dateofbirth}}" type="datetime-local" name="dateofbirth" id="" class="form-control">
            <label for="">Phone</label><br>
            <input value="{{$data->phone}}" type="text" name="phone" id="" class="form-control">
            <label for="">Email</label><br>
            <input value="{{$data->email}}" type="text" name="email"  class="form-control">
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection

           