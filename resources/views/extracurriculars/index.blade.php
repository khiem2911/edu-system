@extends('layouts.main')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .hide {
        display: none;
    }
</style>
@section('content')
    {{-- Result --}}
    @if ($success = Session::get('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ $success }}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    <div class="container-fluid">
        <h1>Extracurricular</h1>
        <div class="d-flex justify-content-end">
            <!-- Thêm d-flex và justify-content-end cho việc đưa nút về phía bên phải -->
            <a href="{{ route('extracurriculars.create') }}" class="btn btn-primary">Add New Item</a>
        </div>
    </div>

    <nav class="navbar ps-0 pe-0">
        <div class="container-fluid">
            <div class="dropdown">
                <button id="deleteAllSe" disabled type="button" class="btn btn-danger deleteAll">Delete All Selected</button>
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Sort
                </button>
                <ul id="selectFilter" style="margin-left: 168px;" class="dropdown-menu">
                    <li>
                        <button class="dropdown-item" value="all">All</button>
                    </li>
                    <li>
                        <button class="dropdown-item" value="old">Sort Oldest to Newest</button>
                    </li>
                    <li>
                        <button class="dropdown-item" value="new">Sort Newest to Oldest</button>
                    </li>
                </ul>
                <i class="ti-angle-double-up" id="icon-up"></i>
                <i class="ti-angle-double-down" id="icon-down"></i>
            </div>
            <div class="d-flex" role="search">
                <input id="keyword" class="form-control" type="search" placeholder="Search" aria-label="Search">
            </div>
        </div>
    </nav>
    {{-- table --}}
    <table class="table table-striped">
        <thead class="table-primary text-center">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Photo</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Start</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                <th scope="col" class="text-center"><input class="form-check-input" type="checkbox" name=""
                        id="select_all_ids">All</th>
            </tr>
        </thead>
        <tbody class="text-center ">
            @foreach ($extracurriculars as $extra)
                <tr id="list{{ $extra->id }}">
                    <th scope="row">{{ $extra->id }}</th>
                    <td style="width:100px"><img style=" width: 100%;
                        height: auto;"
                            src="{{ URL::asset('admin/img') }}/{{ $extra->photo }}" alt=""></td>
                    <td>{{ $extra->name }}</td>
                    <td>{{ $extra->description }}</td>
                    <td>{{ $extra->start_at }}</td>
                    <td> <a href="{{ route('extracurriculars.edit', $extra->id) }}" class="btn btn-info">Edit</a></td>
                    <td>
                        <form class="form-delete" action="{{ route('extracurriculars.destroy', $extra->id) }}"
                            method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa không ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>

                    <td class="text-center"><input class="form-check-input checkbox_ids" name="ids" type="checkbox"
                            value="{{ $extra->id }}" id="flexCheckDefault"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container-fluid d-flex justify-content-end">
        {{ $extracurriculars->links() }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection





@section('js')
    <script>
        // Xóa từng check item
        $(document).ready(function() {
            $('#select_all_ids').click(function() {
                // Xử lí checkAll
                $('.checkbox_ids').prop('checked', $(this).prop('checked'));
                // Cập nhật trạng thái của checkbox "deleteAll" dựa vào trạng thái checked của checkbox "select_all_ids"
                $('.deleteAll').prop('disabled', !$(this).prop('checked'));
            });

            function attachCheckboxChangeEvent() {
                $('.checkbox_ids').on('change', function() {
                    // Kiểm tra xem có ít nhất một checkbox đã được chọn hay không
                    const isAnyCheckboxChecked = $('input:checkbox[name=ids]:checked').length > 0;
                    // Enable/Disable nút "Delete Selected" dựa vào kết quả kiểm tra
                    $('.deleteAll').prop('disabled', !isAnyCheckboxChecked);
                });
            }




            // Xử lí khi nhấn delete All
            $('#deleteAllSe').click(function(e) {
                e.preventDefault();
                // Hiển thị hộp thoại xác nhận trước khi xóa
                Swal.fire({
                    title: 'Bạn có chắc muốn xóa?',
                    text: 'Hành động này không thể hoàn tác!',
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.value == true) {
                        var all_ids = [];
                        $('input:checkbox[name=ids]:checked').each(function() {
                            all_ids.push($(this).val());
                        });
                        $.ajax({
                            url: "{{ route('extracurriculars.delete') }}",
                            type: "DELETE",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                $.each(all_ids, function(key, val) {
                                    $('#list' + val).remove();
                                })
                                // Hiển thị thông báo xóa thành công
                                Swal.fire({
                                    position: 'center',
                                    type: 'success',
                                    title: 'Xóa thành công',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        })
                    }
                })
            })




            // Xử lí search
            // Xử lí tìm kiếm khi nhập trong input
            attachCheckboxChangeEvent();
            var editUrl = "{{ route('extracurriculars.edit', ['extracurricular' => ':id']) }}";
            var deleteUrl = "{{ route('extracurriculars.destroy', ['extracurricular' => ':id']) }}";
            $("#keyword").on('keyup', function(event) {
                var value = $(this).val();
                var pageNumber = 1;
                $.ajax({
                    url: "{{ route('extracurriculars.search') }}",
                    type: "GET",
                    data: {
                        'keyword': value
                    },
                    success: function(data) {
                        var extras = data.extracurriculars;
                        var html = "";
                        if (extras.length > 0) {
                            // Tạo HTML cho kết quả tìm kiếm
                            for (let i = 0; i < extras.length; i++) {
                                var editLink = editUrl.replace(':id', extras[i]['id']);
                                var deleteLink = deleteUrl.replace(':id', extras[i]['id']);
                                html += `
                                                <tr id="list` + extras[i]['id'] + `">
                                    <th scope="row">` + extras[i]['id'] + `</th>
                                    <td style="width:100px"><img style=" width: 100%;
                                        height: auto;"
                                            src="{{ URL::asset('admin/img') }}/` + extras[i]['photo'] + `" alt=""></td>
                                    <td>` + extras[i]['name'] + `</td>
                                    <td>` + extras[i]['description'] + `</td>
                                    <td>` + extras[i]['start_at'] + `</td>
                                    <td> <a href="${editLink}" class="btn btn-info">Edit</a></td>
                                    <td>
                                        <form class="form-delete" action="${deleteLink}"
                                            method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa không ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>

                                    <td class="text-center"><input class="form-check-input checkbox_ids" name="ids" type="checkbox"
                                            value="` + extras[i]['id'] + `" id="flexCheckDefault"></td>
                                </tr>
                                `;
                            }
                        } else {
                            // Hiển thị thông báo không tìm thấy kết quả
                            html = "<tr><td colspan='8'>Không tìm thấy kết quả.</td></tr>";
                        }
                        $("tbody").html(html);
                        attachCheckboxChangeEvent();
                    }
                });
            });



            // Sắp xếp theo ngày
            var selectedOption = "all"; // Đặt giá trị mặc định cho biến selectedOption
            var iconUp = $("#icon-up");
            var iconDown = $("#icon-down");
            iconUp.addClass("hide");
            iconDown.addClass("hide");
            $('#selectFilter .dropdown-item').on('click', function() {
                selectedOption = $(this).val();
                if (selectedOption === "old") {
                    iconUp.addClass("hide");
                    iconDown.removeClass("hide");
                } else if (selectedOption === "new") {
                    iconUp.removeClass("hide");
                    iconDown.addClass("hide");
                } else {
                    iconUp.addClass("hide");
                    iconDown.addClass("hide");
                }
                $.ajax({
                    url: "{{ route('extracurriculars.sort') }}",
                    type: "GET",
                    data: {
                        sort_by: selectedOption
                    },
                    dataType: "json",
                    success: function(response) {
                        var extras = response.extracurriculars;
                        console.log(extras);
                        var html = "";
                        if (extras.length > 0) {
                            for (let i = 0; i < extras.length; i++) {
                                var editLink = editUrl.replace(':id', extras[i]['id']);
                                var deleteLink = deleteUrl.replace(':id', extras[i]['id']);
                                html += `
                                <tr id="list` + extras[i]['id'] + `">
                                    <th scope="row">` + extras[i]['id'] + `</th>
                                    <td style="width:100px"><img style=" width: 100%;
                                        height: auto;"
                                            src="{{ URL::asset('admin/img') }}/` + extras[i]['photo'] + `" alt=""></td>
                                    <td>` + extras[i]['name'] + `</td>
                                    <td>` + extras[i]['description'] + `</td>
                                    <td>` + extras[i]['start_at'] + `</td>
                                    <td> <a href="${editLink}" class="btn btn-info">Edit</a></td>
                                    <td>
                                        <form class="form-delete" action="${deleteLink}"
                                            method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa không ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>

                                    <td class="text-center"><input class="form-check-input checkbox_ids" name="ids" type="checkbox"
                                            value="` + extras[i]['id'] + `" id="flexCheckDefault"></td>
                                </tr>
                                `;
                            }
                        } else {

                        }
                        $("tbody").html(html);
                        attachCheckboxChangeEvent();
                    }
                })
            })
        })
    </script>
@endsection
