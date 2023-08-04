@extends('layouts.main')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div class="container">
            <div class="search">

                <input type="search" name="search" id="search" placeholder="Search introducing here" class="form-control ">
            </div>
        </div>
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">
                <h1 class="mb-0">
                    List Introducing
                </h1>
                <div class="mb-0 ">
                    <form action="">
                        <div class="select-container">
                            <select id="filterIn">
                                <option>Seach All</option>
                                @foreach (\App\Constants\GlobalConstants::LIST as $item)
                                    <option>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <form method="post" action="{{ url('deleteAll') }}">
                {{ csrf_field() }}
                <div class="d-flex align-items-center justify-content-between">
                    <h1 class="mb-0">
                        <button onclick="return confirm('are you sure you want to delete all ')" type="submit"
                            class="btn btn-danger m-o">
                            <i class="bi bi-x-square"></i>
                            Delete All
                        </button>
                    </h1>
                    <button type="button" id="myBtn" class="btn btn-primary">
                        <i class="bi bi-sign-intersection-fill"></i>
                        Add Introducing-Leter
                    </button>
                </div>
                <hr />
                <div id="item-lists">
                    @include('introducing.data')
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
                    <h5 class="modal-title">Add Introducing</h5>
                    <button type="button" id="closeModalBtn" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="comment" action="" method="post">
                        {{ csrf_field() }}
                        <div class="form-floating mb-3">
                            <input id="name" value="<?php echo old('name'); ?>" type="text" class="form-control"
                                name="name" id="floatingInput" placeholder="Nhập tên hội nghị">
                            <label for="floatingInput">Name Introducing</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input id="contents" value="<?php echo old('content'); ?>" type="text" class="form-control"
                                name="content" id="floatingInput" placeholder="Nhập nội dung hội nghị">
                            <label for="floatingInput">Content Introducing</label>
                        </div>
                        <br>
                        <h3><b>Time start</b> </h3>
                        <input id="timeStart" name="timestart" type="datetime-local" value="<?php echo old('timestart'); ?>" />
                        <br>
                        <h3><b>Time end</b></h3>
                        <input id="timeEnd" name="timeend" type="datetime-local" value="<?php echo old('timeend'); ?>" />
                        <br>
                        <button id="testbtn" type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#myBtn").click(function() {
                $("#myModal").modal("show");
            })
            $("#closeModalBtn").click(function() {
                $("#myModal").modal("hide");
            })
            $('#comment').on('submit', function(e) {
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
                    method: "POST",
                    url: "/checkAddIn",
                    data: {
                        'name': name,
                        'content': content,
                        'timestart': timestart,
                        'timeend': timeend,
                    },
                    success: function(data) {
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
            $(document).on('click', '#deletebtn', function(event) {
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
                    if (result.value == true) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            method: "GET",
                            url: "{{ route('deleteIntroducing') }}",
                            data: {
                                'id': id,
                            },
                            success: function(data) {
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
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var myurl = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];
                getData(page);
            });
            $('#filterIn').on('change', function() {
                var select = $("#filterIn option:selected").val();
                console.log(select);
                if (select) {
                    if (select == "ALL") {
                        $('.alldata').show();
                        $('.searchdata').hide();
                    } else {
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
                    method: "GET",
                    url: "{{ route('filterIntroducing') }}",
                    data: {
                        'select': select,
                    },
                    success: function(data) {
                        $('.searchdata').html(data);
                    },
                    error: (error) => {}
                })
            });

            function getData(page) {
                $.ajax({
                        url: '?page=' + page,
                        type: "get",
                        datatype: "html",
                    })
                    .done(function(data) {
                        $("#item-lists").empty().html(data);
                        location.hash = page;
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        alert('No response from server');
                    });
            }
            $(document).on('keyup', '#search', function() {
                $value = $(this).val();
                if ($value) {
                    $('.alldata').hide();
                    $('.searchdata').show();
                } else {
                    $('.alldata').show();
                    $('.searchdata').hide();
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "GET",
                    url: "{{ route('searchIntroducing') }}",
                    data: {
                        'search': $value,
                    },
                    success: function(data) {
                        console.log(data);
                        $('.searchdata').html(data);
                    },
                    error: (error) => {
                        console.log(JSON.stringify(error));
                    }
                })
            })
        })
    </script>
@endsection
