@extends('layouts.main')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div class="search">
            <nav class="navbar ">
                <div class="container-fluid">
                    <div class="d-flex ms-auto" role="search">
                        <input type="search" name="search" id="search" placeholder="Search seminar name"
                            class="form-control me-2">
                    </div>
            </nav>
        </div>
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">
                <h1 class="mb-0">
                    List Seminars
                </h1>
                <div class="mb-0 ">
                    <form action="">
                        <div class="select-container">
                            <select id="filterser">
                                <option>ALL</option>
                                @foreach (\App\Constants\GlobalConstants::LIST as $item)
                                    <option>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <form method="post" action="{{ route("deleteAll") }}">
                {{ csrf_field() }}
                <div class="d-flex align-items-center justify-content-between">
                    <h1 class="mb-0">
                        <button disabled id="deleteAllBtn" onclick="return confirm('are you sure you want to delete all ')"
                            type="submit" class="btn btn-danger m-o">
                            Delete All
                        </button>
                    </h1>
                    <button type="button" id="myBtn" class="btn btn-primary">
                        Add Seminar
                    </button>
                </div>
                <hr />
                <div id="item-lists">
                    @include('seminar.data')
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
                            <input id="name" value="<?php echo old('name'); ?>" type="text" class="form-control"
                                name="name" id="floatingInput" required>
                            <label id="labelName" for="floatingInput">Name Seminar</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input id="contents" value="<?php echo old('content'); ?>" type="text" class="form-control"
                                name="content" id="floatingInput" required>
                            <label id="labelContent" for="floatingInput">Content Seminar</label>
                        </div>

                        <br>
                        <div class="d-flex justify-content-center">
                            <div id="loading" class="spinner-border hidden" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <h3><b id="labelTimeStart">Time start</b> </h3>
                        <input required id="timeStart" name="timestart" type="datetime-local" value="<?php echo old('timestart'); ?>" />
                        <br>
                        <h3><b id="labelTimeEnd">Time end</b></h3>
                        <input required id="timeEnd" name="timeend" type="datetime-local" value="<?php echo old('timeend'); ?>" />
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
            
         
            $(document).on('click', '#select-all', function(event) {
                if (this.checked) {
                    $('#deleteAllBtn').removeAttr('disabled');
                    $(':checkbox').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('#deleteAllBtn').attr('disabled', 'disabled');
                    $(':checkbox').each(function() {
                        this.checked = false;
                    });
                }
            })
            $(document).on('click', '#checkItem', function(event) {
                var arr = [];
                $.each($("input[name='checkbox[]']:checked"), function() {
                    arr.push($(this).val());
                });
                if (this.checked) {
                    $('#deleteAllBtn').removeAttr('disabled');
                } else {
                    if (arr.length == 0) {
                        $('#deleteAllBtn').attr('disabled', 'disabled');
                    }
                }
            })



            $("#myBtn").click(function() {
                $("#myModal").modal("show");
            })
            $("#closeModalBtn").click(function() {
                $("#myModal").modal("hide");
            })
            $('#comment').on('submit', function(e) {
                e.preventDefault();
                let loader = document.querySelector('#loading')
                loader.style.display = 'block';
                loader.classList.remove('hidden');
                setTimeout(() => loader.style.display = 'none', 1000);
                $('#name').attr('hidden', 'hidden');
                $('#labelName').attr('hidden', 'hidden');
                $('#testbtn').attr('hidden', 'hidden');
                $('#contents').attr('hidden', 'hidden');
                $('#labelContent').attr('hidden', 'hidden');
                $('#timeStart').attr('hidden', 'hidden');
                $('#labelTimeStart').attr('hidden', 'hidden');
                $('#timeEnd').attr('hidden', 'hidden');
                $('#labelTimeEnd').attr('hidden', 'hidden');
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
                    url: "/checkAdd",
                    data: {
                        'name': name,
                        'content': content,
                        'timestart': timestart,
                        'timeend': timeend,
                    },
                    success: function(data) {
                        $('#name').removeAttr('hidden');
                        $('#labelName').removeAttr('hidden');
                        $('#testbtn').removeAttr('hidden');
                        $('#contents').removeAttr('hidden');
                        $('#labelContent').removeAttr('hidden');
                        $('#timeStart').removeAttr('hidden');
                        $('#labelTimeStart').removeAttr('hidden');
                        $('#timeEnd').removeAttr('hidden');
                        $('#labelTimeEnd').removeAttr('hidden');
                        $("#myModal").modal("hide");
                        Swal.fire({
                            type: 'success',
                            title: 'Nofication',
                            text: 'Added Successed',
                        });
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
                            url: "{{ route('deleteSeminar') }}",
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
                var page = $(this).attr('href').split('page=')[1];
                getData(page)
            });
            
            $('#filterser').on('change', function() {
                var select = $("#filterser option:selected").val();
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
                    url: "{{ route('filterSerminar') }}",
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
                    url: "{{ route('searchSerminar') }}",
                    data: {
                        'search': $value,
                    },
                    success: function(data) {
                       
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
