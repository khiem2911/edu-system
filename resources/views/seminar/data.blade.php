<table class="table table-hover table-bordered">
    <thead class="table-primary">
        <tr>
            <th><input type="checkbox" name="select-all" id="select-all" /></th>
            <th>Id
                <span class="float-right text-sm">
                    <i data-sorting_type="asc" data-column_name="id" style="cursor: pointer"
                        class="seminar_sorting fa fa-arrow-up"></i>
                    <i data-sorting_type="desc" data-column_name="id" style="cursor: pointer"
                        class="seminar_sorting fa fa-arrow-down"></i>
                </span>
            </th>
            <th> Name</th>
            <th>Content</th>
            <th>Time start</th>
            <th>Time end</th>
            <th style="width:13%;">Actions</th>
        </tr>
    </thead>
    <tbody class="alldata">
        @foreach ($data as $item)
<<<<<<< HEAD
            <tr>
                <td class="text-center align-middle "><input name='checkbox[]' type="checkbox" id="checkItem"
                        value="{{ $item->id }}">
                <td class="align-middle">{{ $item->id }}</td>
                <td class="align-middle">{{ $item->name }}</td>
                <td class="align-middle">{{ $item->content }}</td>
                <td class="align-middle">{{ $item->timestart }}</td>
                <td class="align-middle">{{ $item->timeend }}</td>
                <input id="idser" type="hidden" value="{{ $item->id }}">
                <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('editSeminar', $item->id) }}" class="btn btn-warning">Edit</a>
                        <a id="deletebtn" data-id="{{ $item->id }}" href="" class="btn btn-danger">Delete</a>

                    </div>
                </td>
            </tr>
=======
        <tr>
            <td class="text-center align-middle"><input name='id[]' type="checkbox" id="checkItem" 
                value="{{$item->id}}">
            <td  class="align-middle">{{$item->id}}</td>
            <td class="align-middle">{{$item->name}}</td>
            <td class="align-middle">{{$item->content}}</td>
            <td class="align-middle">{{$item->timestart}}</td>
            <td class="align-middle">{{$item->timeend}}</td>
            <input id="idser" type="hidden" value="{{$item->id}}">
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                     <a  href="{{route("editIntroducing",$item->id)}}" class="btn btn-warning">Edit</a>
                     <a id="deletebtn" data-id="{{$item->id}}"  href="" class="btn btn-danger">Delete</a>
                     
                </div>
            </td>
        </tr>
>>>>>>> 0f5bcd2ec1261464d16772c6b76aca5d6f3be4d3
        @endforeach
    </tbody>
    <tbody id="content" class="searchdata">

    </tbody>
</table>
<div class="pagination">
    {!! $data->render() !!}
</div>
