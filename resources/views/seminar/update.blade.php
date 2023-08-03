@extends('layouts.main')
@section('content')
<div class="card" style="margin:20px;">
    <div class="card-header">
       <h4>Edit Seminar</h4>
    </div>
    <div class="card-body">
        <form id="onUpdate" >
            {{ csrf_field() }}
            <label for="">Name</label><br>
            <input value="{{$data->name}}" type="text" name="name" id="name" class="form-control">
            <label for="">Content</label><br>
            <input value="{{$data->content}}" type="text" name="content" id="contents"  class="form-control">
            <label for="">Time start</label><br>
            <input value="{{$data->timestart}}" type="datetime-local" name="timestart" id="timeStart" class="form-control">
            <label for="">Time end</label><br>
            <input value="{{$data->timeend}}" type="datetime-local" name="timeend" id="timeEnd" class="form-control"><br>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
@section('js')
  <script> 
   $(document).ready(function(){
    $('#onUpdate').on('submit', function(e) {
        e.preventDefault();
       var id = {{$data->id}};
       var name = $("#name").val();
       var content = $("#contents").val();
       var timestart = $("#timeStart").val();
       var timeend = $("#timeEnd").val();
       $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
       $.ajax({
                    method: "POST",
                    url: "/updateSer",
                    data: {
                        'id':id,
                        'name': name,
                        'content': content,
                        'timestart': timestart,
                        'timeend': timeend,
                    },
                    success: function(data) {
                        if(data.status==false)
                        {
                            Swal.fire({
                            type: 'error',
                            title: 'Nofication',
                            text: 'Do not empty input field',
                        });
                        };
                        if(data.status==true){
                                Swal.fire({
                            type: 'success',
                            title: 'Nofication',
                            text: 'Added Successed',
                        }).then((result)=>{
                           if(result.value==true){
                            window.location.href="/seminar";
                           }
                        });
                    }else{
                        window.location.href="/seminar";
                    };
                    },
                    error: (error) => {
                        console.log(error);
                    }
                });
    });
   })
</script>
@endsection

           