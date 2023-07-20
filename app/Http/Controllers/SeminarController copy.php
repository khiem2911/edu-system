<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
Use Exception;
class SeminarController extends Controller
{
    /*
    public function addSeminar(Request $request) {
        $name = $request->name;
        $content = $request->content;
        $timestart =$request->timestart;
        $timeend =$request->timeend;
        $query=false;
        $alert=false;
        $values = array('name' => $name,'content' => $content,'timestart'=>$timestart,'timeend'=>$timeend);
        try{
          $query=DB::table('Seminar')->insert($values);
        }catch(Exception)
        {
           $alert = alert()->error('Failed','Kiểm tra lại các ô nhập');
           $request->flash();
        }
        if($query)
        {
            alert()->success('Add Successed');
            return redirect()->route("home");
        }
        if($alert)
        {
            return redirect()->route('home', ['alert' => $alert]);
        }
    }
    */
    public function deleteAllSeminar(Request $request){
        $id = $request->id;
        $alert;
        if($id==null)
        {
            $count = DB::table('Seminar')->count();
            if($count==0)
            {
                $alert = alert()->warning('Nothing to delete');
                return redirect()->route('home', ['alert' => $alert]);
            }else
            {
                DB::table('Seminar')->delete();
                $alert = alert()->success('Delete Successed');
                return redirect()->route('home', ['alert' => $alert]);
            }
            $alert = alert()->warning('Please select at least 1 to delete');
           return redirect()->route('home', ['alert' => $alert]);
        }else
        {
            foreach($id as $item)
            {
                $deleted = DB::table('Seminar')->where('id', '=', $item)->delete();
            }
            if($deleted)
        {
            alert()->success('Delete Successed');
            return redirect()->route("home");
        }
        }
    }
    public function addSeminar(Request $request)  {
        $name = $request->name;
        $content = $request->content;
        $timestart = $request->timestart;
        $timeend = $request->timeend;
        $query=false;
        $values = array('name' => $name,'content' => $content,'timestart'=>$timestart,'timeend'=>$timeend);
        try{
            $query=DB::table('Seminar')->insert($values);
            $data = DB::table('Seminar')->paginate(5);
            $html = view('data', compact('data'))->render();
            return response()->json([
                'status' => true,
                'html' => $html,
            ]);
          }catch(Exception)
          {
             $alert = alert()->error('Failed','Kiểm tra lại các ô nhập');
             $request->flash();
          }
    }
    public function deleteSeminar(Request $request){
        $deleted = DB::table('Seminar')->where('id', '=', $request->id)->delete();
        $data = DB::table('Seminar')->paginate(5);
        $html = view('data', compact('data'))->render();
            return response()->json([
                'status' => true,
                'html' => $html,
            ]);
    }
    public function updateSeminar(Request $request,$id){
        $name = $request->name;
        $content = $request->content;
        $timestart =$request->timestart;
        $timeend =$request->timeend;
        $values = array('name' => $name,'content' => $content,'timestart'=>$timestart,'timeend'=>$timeend);
        $query = DB::table('Seminar')->where('id', '=', $id)->update($values);
        if($query)
        {
            alert()->success('Update Successed');
        }
        return redirect()->route("home");
    }
    public function editSeminar($id){
        $data = DB::select('select * from Seminar where id = ?', [$id]);
        if($data)
        {
            return view("update")->with("data",$data[0]);
        }
       
    }
    public function filterSeminar(Request $request){
       $select = $request->select;
       $output="";
        if($select)
        {
            if($select=="Theo thứ tự giảm dần")
            {
                $data =  DB::table('Seminar')->orderBy('id', 'DESC')->paginate(5);
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
                         <a  href="/EditSer/'.$item->id.'" class="btn btn-warning">Edit</a>
                         <a id="deleteBtn" href="checkDelete/'.$item->id.'" class="btn btn-danger">Delete</a>
                    </div>
                 </td>
                    </tr>
                    ';
                }
                return response($output);
            }
            if($select=="A tới Z")
            {
                $data =  DB::table('Seminar')->orderBy('name', 'ASC')->paginate(5);
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
                         <a  href="/EditSer/'.$item->id.'" class="btn btn-warning">Edit</a>
                         <a id="deleteBtn" href="checkDelete/'.$item->id.'" class="btn btn-danger">Delete</a>
                    </div>
                 </td>
                    </tr>
                    ';
                }
                return response($output);
            }
        }
    }
    public function searchSeminar(Request $request){
        $data =  DB::table('Seminar')->where('name', 'like', '%' . $request->search . '%')->paginate(5);
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
                 <a  href="/EditSer/'.$item->id.'" class="btn btn-warning">Edit</a>
                 <a id="deleteBtn" href="checkDelete/'.$item->id.'" class="btn btn-danger">Delete</a>
            </div>
         </td>
            </tr>
            ';
        }
        return response($output);
    }
    public function loadData(Request $request){
        
            $data = DB::table('Seminar')->paginate(5);
            if ($request->ajax()) {
                return view('data', compact('data'));
            }
            return view('dashboard',compact('data'));
        
    }
}
