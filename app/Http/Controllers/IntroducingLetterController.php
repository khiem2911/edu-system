<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
Use Exception;
class IntroducingLetterController extends Controller
{
    public function deleteAllIntroducing(Request $request)
    {
        $id = $request->id;
        $alert;
        if($id==null)
        {
            $count = DB::table('introducing')->count();
            if($count==0)
            {
                $alert = alert()->warning('Nothing to delete');
                return redirect()->route('homeIntroducing', ['alert' => $alert]);
            }else
            {
                DB::table('introducing')->delete();
                $alert = alert()->success('Delete Successed');
                return redirect()->route('homeIntroducing', ['alert' => $alert]);
            }
            $alert = alert()->warning('Please select at least 1 to delete');
           return redirect()->route('homeIntroducing', ['alert' => $alert]);
        }else
        {
            foreach($id as $item)
            {
                $deleted = DB::table('introducing')->where('id', '=', $item)->delete();
            }
            if($deleted)
        {
            alert()->success('Delete Successed');
            return redirect()->route("homeIntroducing");
        }
        }
    }
    public function fetch_introducing(Request $request)
    {
        if($request->ajax())
        {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $data = DB::table('introducing')
                ->orderBy($sort_by, $sort_type)
                ->paginate(5);
            return view('introducing.pagination', compact('data'))->render();
        }
    }
    public function addIntroducing(Request $request)
    { 
        $name = $request->name;
        $content = $request->content;
        $timestart = $request->timestart;
        $timeend = $request->timeend;
        $query = false;


        $request->session()->flush();
        $values = ['name' => $name, 'content' => $content, 'timestart' => $timestart, 'timeend' => $timeend];
        $request->session()->reflash();
        $query = DB::table('introducing')->insert($values);
        $data = DB::table('introducing')->paginate(5);
        $html = view('introducing.data', compact('data'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
        ]);
    }

    

    public function deleteIntroducing(Request $request){
        $deleted = DB::table('introducing')
            ->where('id', '=', $request->id)
            ->delete();
        $data = DB::table('introducing')->paginate(5);
        $html = view('introducing.data', compact('data'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
        ]);
    }
    public function updateIntroducing(Request $request,$id)
    {
        $name = $request->name;
        $content = $request->content;
        $timestart =$request->timestart;
        $timeend =$request->timeend;
        if($name==null||$content==null||$timestart==null||$timeend==null){
            alert()->warning('PLEASE DO NOT EMPTY');
            return redirect()->route('editIntroducing',['id'=>$id]);
        }else
        {
        $values = ['name' => $name, 'content' => $content, 'timestart' => $timestart, 'timeend' => $timeend];
        $query = DB::table('introducing')
            ->where('id', '=', $id)
            ->update($values);
        if ($query) {
            alert()->success('Update Successed');
        }
        return redirect()->route('homeIntroducing');
    }
    }
    public function editIntroducing($id){
        $data = DB::select('select * from introducing where id = ?', [$id]);
        if($data)
        {
            return view("introducing.update")->with("data",$data[0]);
        }
       
    }
    public function filterIntroducing(Request $request)
    {
        $select = $request->select;
        $output = '';
        if ($select) {
            if ($select == 'Theo thứ tự ID giảm dần') {
                $data = DB::table('introducing')
                    ->orderBy('id', 'DESC')
                    ->paginate(5);
                $output = '';
                foreach ($data as $item) {
                    $output .=
                        '
                    <tr>
                    <td class="text-center align-middle"><input name="id[]" type="checkbox" id="checkItem"
                    value=' .
                        $item->id .
                        '>
                    <td class="align-middle"> ' .
                        $item->id .
                        ' </td>
                    <td class="align-middle"> ' .
                        $item->name .
                        ' </td>
                    <td class="align-middle"> ' .
                        $item->content .
                        ' </td>
                    <td class="align-middle"> ' .
                        $item->timestart .
                        ' </td>
                    <td class="align-middle"> ' .
                        $item->timeend .
                        ' </td>
                    <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                         <a  href="/EditIn/' .
                        $item->id .
                        '" class="btn btn-warning">Edit</a>
                         <a id="deleteBtn" href="checkDelete/' .
                        $item->id .
                        '" class="btn btn-danger">Delete</a>
                    </div>
                 </td>
                    </tr>
                    ';
                }
                return response($output);
            }
            if ($select == 'A tới Z(Name)') {
                $data = DB::table('introducing')
                    ->orderBy('name', 'ASC')
                    ->paginate(5);
                $output = '';
                foreach ($data as $item) {
                    $output .=
                        '
                    <tr>
                    <td class="text-center align-middle"><input name="id[]" type="checkbox" id="checkItem"
                    value=' .
                        $item->id .
                        '>
                    <td class="align-middle"> ' .
                        $item->id .
                        ' </td>
                    <td class="align-middle"> ' .
                        $item->name .
                        ' </td>
                    <td class="align-middle"> ' .
                        $item->content .
                        ' </td>
                    <td class="align-middle"> ' .
                        $item->timestart .
                        ' </td>
                    <td class="align-middle"> ' .
                        $item->timeend .
                        ' </td>
                    <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                         <a  href="/EditIn/' .
                        $item->id .
                        '" class="btn btn-warning">Edit</a>
                         <a id="deleteBtn" href="checkDelete/' .
                        $item->id .
                        '" class="btn btn-danger">Delete</a>
                    </div>
                 </td>
                    </tr>
                    ';
                }
                return response($output);
            }
        }
    }
    public function searchIntroducing(Request $request){
        $data =  DB::table('introducing')->where('name', 'like', '%' . $request->search . '%')->paginate(5);
        $output="";
        foreach($data as $item)
        {
            $output.=
            '
            <tr>
            <td class="text-center align-middle"><input name="id[]" type="checkbox" id="checkItem" 
            value='.$item->id.'>
            <td class="align-middle"> '.$item->id.' </td>
            <td class="align-middle"> '.$item->name.' </td>
            <td class="align-middle"> '.$item->content.' </td>
            <td class="align-middle"> '.$item->timestart.' </td>
            <td class="align-middle"> '.$item->timeend.' </td>
            <td class="align-middle">
            <div class="btn-group" role="group" aria-label="Basic example">
                 <a  href="/EditIn/'.$item->id.'" class="btn btn-warning">Edit</a>
                 <a id="deleteBtn" href="checkDelete/'.$item->id.'" class="btn btn-danger">Delete</a>
            </div>
         </td>
            </tr>
            ';
        }
        return response($output);
    }
    public function loadData(Request $request) {
        $data = DB::table('introducing')
            ->orderBy('id', 'asc')
            ->paginate(5);
        if($request->ajax()){
            return view('introducing.data', compact('data'));
        }
        return view('introducing.index', compact('data'));
    }
    
}
