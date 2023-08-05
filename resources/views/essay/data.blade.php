
<table class="table table-hover table-bordered" >
    <thead class="table-primary">
        <tr>
            <th>
            <span class="float-right text-sm">
                <input type="checkbox" name="select-all" id="select-all" />
                    <i data-sorting_type="asc" data-column_name="id" style="cursor: pointer"
                        class="essay_sorting fa fa-arrow-up"></i>
                    <i data-sorting_type="desc" data-column_name="id" style="cursor: pointer"
                        class="essay_sorting fa fa-arrow-down"></i>
                </span>
            </th>
            <th>Id</th>
            <th> Name</th>
            <th>Address</th>
            <th>Essay Title</th>
            <th>Content</th>
            <th style="width:13%;">Actions</th>
        </tr>
    </thead>
    <tbody class="alldata" id="dataEssay">
        @foreach ($data as $item)
            <tr>
                <td class="text-center align-middle "><input name='checkbox[]' type="checkbox" id="checkItem" value="{{ $item->id }}"></td>
                <td class="align-middle">{{ $item->id }}</td>
                <td class="align-middle">{{ $item->name }}</td>
                <td class="align-middle">{{ $item->content }}</td>
                <td class="align-middle">{{ $item->essaytitle }}</td>
                <td class="align-middle">{{ $item->content }}</td>
                <input id="idser" type="hidden" value="{{ $item->id }}">
                <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('editEssay', $item->id) }}" class="btn btn-warning">Edit</a>
                        <a id="deletebtn" data-id="{{ $item->id }}" href="" class="btn btn-danger">Delete</a>

                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tbody id="content" class="searchdata">

    </tbody>
</table>
<div class="pagination">
    {!! $data->render() !!}
</div>
