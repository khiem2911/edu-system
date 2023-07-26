<table class="table table-hover table-bordered">
    <thead class="table-primary">
        <tr>
            <th><input type="checkbox" name="select-all" id="select-all" /></th>
            <th class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">Id <span
                    id="id_icon"></span></th>
            <th> Name</th>
            <th>Content</th>
            <th>Time start</th>
            <th>Time end</th>
            <th style="width:13%;">Actions</th>
        </tr>
    </thead>
    <tbody class="alldata">
        @include('seminar.pagination')
    </tbody>
    <tbody id="content" class="searchdata">

    </tbody>
</table>
<input type="hidden" name="hidden_page" id="hidden_page" value="1">
<input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id">
<input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc">
{!! $data->links() !!}
