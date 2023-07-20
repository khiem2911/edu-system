<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .content{
            padding-left: 100px;
            padding-right: 100px;
            border-width: 2px;
            border-color: black
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

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Seminar Edusystem </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

           


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </nav>
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
               
</body>
</html>