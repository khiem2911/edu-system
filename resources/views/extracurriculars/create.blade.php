@extends('layouts.main')
@section('content')
    <h1 class="mt-4">Create New Item</h1>
    <div class="modal-body">
        <form action="{{route('extracurriculars.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input required type="name" class="form-control" id="name" name="name" placeholder="Name">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea required class="form-control" id="description" name="description" rows="3" placeholder="..."></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Start</label>
                <input required type="date" class="form-control" id="start_at" name="start_at">
            </div>
            <div class="mb-3">
                <label for="formFileLg" class="form-label">Upload photo</label>
                <input required class="form-control form-control-lg" id="photo"name="photo" type="file">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary me-1" id="inputBtn">Add New Item</button>
            </div>
        </form>
    </div>
@endsection



@section('js')

@endsection
