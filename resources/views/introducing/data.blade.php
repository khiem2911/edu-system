<table class="table table-hover table-bordered">
    <thead class="table-primary">
        <tr>
            <th><input type="checkbox" name="select-all" id="select-all" /></th>
            <th>Id</th>
            <th>Name</th>
            <th>Content</th>
            <th>Time start</th>
            <th>Time end</th>
            <th style="width:13%;">Actions</th>
        </tr>
    </thead>
    <tbody class="alldata">
        @foreach ($data as $item)
            <tr>
                <td class="text-center align-middle "><input name='checkbox[]' type="checkbox" id="checkItem"
                        value="{{ $item->id }}">
                <td class="align-middle">{{ $item->id }}</td>
                <td class="align-middle">{{ $item->name }}</td>
                <td class="align-middle">{{ $item->content }}</td>
                <td class="align-middle">{{ $item->timestart }}</td>
                <td class="align-middle">{{ $item->timeend }}</td>
                <input id="id" type="hidden" value="{{ $item->id }}">
                <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('editIntroducing', $item->id) }}" class="btn btn-warning"><i class="bi bi-brush"></i>Edit</a>
                        <a id="deletebtn" data-id="{{ $item->id }}" href="" class="btn btn-danger"><i class="bi bi-x-square"></i>Delete</a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tbody id="content" class="searchdata">

    </tbody>
</table>

{!! $data->links() !!}
