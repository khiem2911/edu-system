<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Content</th>
            <th>Time start</th>
            <th>Time end</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="alldata">
        @foreach ($data as $item)
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
                     <a  href="{{route("editSeminar",$item->id)}}" class="btn btn-warning">Edit</a>
                     <a id="deletebtn" data-id="{{$item->id}}"  href="" class="btn btn-danger">Delete</a>
                     
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tbody id="content" class="searchdata">

    </tbody>
  </table>
  <div class="pagination">
    {!! $data->render()!!}
  </div>