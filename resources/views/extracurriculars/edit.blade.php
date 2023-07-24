@extends('layouts.main')
@section('content')
    <h1 class="mt-4">Edit Item</h1>
    <div class="modal-body">
        <form action="{{ route('extracurriculars.update', $extra->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="name" class="form-control" id="name" name="name" placeholder="Name"
                    value="{{ $extra->name }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="...">{{ $extra->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Start</label>
                <input type="date" class="form-control" id="start_at" name="start_at" value="{{ $extra->start_at }}">
            </div>
            <div class="mb-3">
                <label for="formFileLg" class="form-label">Upload photo</label>
                <input class="form-control form-control-lg" id="photo"name="photo" value="{{ $extra->photo }}"
                    type="file">
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
@endsection






@section('js')
@endsection
