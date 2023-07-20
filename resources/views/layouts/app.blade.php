<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Serminar</title>
    <script src="{{ asset('js/app.js') }}"></script>
  <!-- Fonts -->
  <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Styles -->
  <style>
      /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--tw-bg-opacity: 1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gray-100{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.border-gray-200{--tw-border-opacity: 1;border-color:rgb(229 231 235 / var(--tw-border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{--tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);--tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.text-center{text-align:center}.text-gray-200{--tw-text-opacity: 1;color:rgb(229 231 235 / var(--tw-text-opacity))}.text-gray-300{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity))}.text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}.text-gray-600{--tw-text-opacity: 1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-700{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity: 1;color:rgb(17 24 39 / var(--tw-text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--tw-bg-opacity: 1;background-color:rgb(31 41 55 / var(--tw-bg-opacity))}.dark\:bg-gray-900{--tw-bg-opacity: 1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:border-gray-700{--tw-border-opacity: 1;border-color:rgb(55 65 81 / var(--tw-border-opacity))}.dark\:text-white{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}}
  </style>

  <style>
      body {
          font-family: 'Nunito', sans-serif;
      }
  </style>
    <!-- Custom fonts for this template-->
      <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
      <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Seminar Edusystem </div>
            </a>
            
            <hr class="sidebar-divider my-0">
            <br>
            
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="container">
                        <div class="search">
                            <input type="search" name="search" id="search" placeholder="Search seminar here" class="form-control" >
                        </div>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">
                           List Seminars
                        </h1>
                      <div class="mb-0 btn btn-primary">
                        <form action="">
                            <div class="select-container">
                                <select  id="filterser">
                                    <option>ALL</option>
                                    @foreach (\App\Constants\GlobalConstants::LIST as $item)
                                    <option>{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                      </div>
                    </div>
                    <form method="post" action="{{url('deleteAll')}}">
                        {{ csrf_field() }}
              <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">
                            <button onclick="return confirm('are you sure you want to delete all ')"  type="submit" class="btn btn-danger m-o">
                                Delete All
                               </button>
                        </h1>
                        <button type="button" id="myBtn"  class="btn btn-primary">
                           Add Seminar
                          </button>
              </div>
              <hr/>
              <div id="item-lists">
              @include('data')
            </div>
        </form>
        </div>
    </div>
    @include('sweetalert::alert')
    <!-- Modal -->

    <div id="myModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add seminar</h5>
              <button type="button" id="closeModalBtn" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="comment" action="" method="post">
                    {{ csrf_field() }}
                    <div class="form-floating mb-3">
                        <input id="name" value="<?php echo(old("name")); ?>" type="text" class="form-control" name="name" id="floatingInput" placeholder="Nhập tên hội nghị">
                        <label for="floatingInput">Name Seminar</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input id="contents" value="<?php echo(old("content")); ?>" type="text" class="form-control" name="content" id="floatingInput" placeholder="Nhập nội dung hội nghị">
                        <label for="floatingInput">Content Seminar</label>
                      </div>
                     
                    <br>    
                    <h3><b>Time start</b> </h3>
                    <input id="timeStart" name="timestart" type="datetime-local" value="<?php echo(old("timestart")); ?>" />
                    <br>
                    <h3><b>Time end</b></h3>
                    <input id="timeEnd" name="timeend" type="datetime-local" value="<?php echo(old("timeend")); ?>" />
                    <br>
                    <button id="testbtn" type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript"> 
        $(document).ready(function(){
    $("#myBtn").click(function(){
      $("#myModal").modal("show");
    })
    $("#closeModalBtn").click(function(){
      $("#myModal").modal("hide");
    })  
    $( '#comment' ).on( 'submit', function(e) {
        e.preventDefault();
        $("#myModal").modal("hide");
        var name = $('#name').val();
        var content = $('#contents').val();
        var timestart = $('#timeStart').val();
        var timeend = $('#timeEnd').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            method:"POST",
            url:"/checkAdd",
            data:{
                'name':name,
                'content':content,
                'timestart':timestart,
                'timeend':timeend
            }
                ,
            success:function(data)
            {
                    Swal.fire({
                    type: 'success',
  title: 'Nofication',
  text: 'Added Successed',
}),
            $('#item-lists').html(data.html);
            },
            error: (error) => {
                console.log(error);
   }
    });
});
$(document).on('click','#deletebtn',function(event){
    event.preventDefault();
    var id = $(this).data("id");
    Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
           if(result.value==true)
           {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            method:"GET",
            url:"{{route('deleteSeminar')}}",
            data:{
                'id':id,
            }
                ,
            success:function(data)
            {
                Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
    $('#item-lists').html(data.html);
            }, 
            error: (error) => {
                console.log(error);
   }
        })
           }
        })
});
    $(document).on('click', '.pagination a',function(event)
    {
        event.preventDefault();
        var myurl = $(this).attr('href');
        var page=$(this).attr('href').split('page=')[1];
        getData(page);
    });
    $('#filterser').on('change',function(){
        var select =$("#filterser option:selected").val();
        console.log(select);
        if(select)
        {
            if(select=="ALL")
            {
                $('.alldata').show();
                $('.searchdata').hide();
            }else
            {
                $('.alldata').hide();
                $('.searchdata').show();
            }
          
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            method:"GET",
            url:"{{ route('filter') }}",
            data:{
                'select':select,
            }
                ,
            success:function(data)
            {
                $('.searchdata').html(data);
            }, 
            error: (error) => {
   }
        })
    });

function getData(page){
    $.ajax({
        url: '?page=' + page,
        type: "get",
        datatype: "html",
    })
    .done(function(data){
        $("#item-lists").empty().html(data);
        location.hash = page;
    })
    .fail(function(jqXHR, ajaxOptions, thrownError){
      alert('No response from server');
    });
  }

  $('#search').on('keyup',function()
    {
        $value=$(this).val();
        if($value)
        {
            $('.alldata').hide();
            $('.searchdata').show();
        }else{
            $('.alldata').show();
            $('.searchdata').hide();
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            method:"GET",
            url:"{{ route('search') }}",
            data:{
                'search':$value,
            }
                ,
            success:function(data)
            {
                console.log(data);
                $('.searchdata').html(data);
            }, 
            error: (error) => {
                     console.log(JSON.stringify(error));
   }
        })
    }
  )
})
          </script>
         
</body>

</html>