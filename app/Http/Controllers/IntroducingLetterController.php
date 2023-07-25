<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
Use Exception;
class IntroducingLetterController extends Controller
{
    public function deleteAllIntroducing(Request $request){
        $id = $request->id;
        $alert;
        if($id==null)
        {
            $count = DB::table('Introducing')->count();
            if($count==0)
            {
                $alert = alert()->warning('Nothing to delete');
                return redirect()->route('homeIntroducing', ['alert' => $alert]);
            }else
            {
                DB::table('Introducing')->delete();
                $alert = alert()->success('Delete Successed');
                return redirect()->route('homeIntroducing', ['alert' => $alert]);
            }
            $alert = alert()->warning('Please select at least 1 to delete');
           return redirect()->route('homeIntroducing', ['alert' => $alert]);
        }else
        {
            foreach($id as $item)
            {
                $deleted = DB::table('Introducing')->where('id', '=', $item)->delete();
            }
            if($deleted)
        {
            alert()->success('Delete Successed');
            return redirect()->route("homeIntroducing");
        }
        }
    }
    public function addIntroducing(Request $request)  {
        $name = $request->name;
        $content = $request->content;
        $timestart = $request->timestart;
        $timeend = $request->timeend;
        $query=false;
        $values = array('name' => $name,'content' => $content,'timestart'=>$timestart,'timeend'=>$timeend);
        try{
            $query=DB::table('Introducing')->insert($values);
            $data = DB::table('Introducing')->paginate(5);
            $html = view('introducing.data', compact('data'))->render();
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
    public function deleteIntroducing(Request $request){
        $deleted = DB::table('Introducing')->where('id', '=', $request->id)->delete();
        $data = DB::table('Introducing')->paginate(5);
        $html = view('introducing.data', compact('data'))->render();
            return response()->json([
                'status' => true,
                'html' => $html,
            ]);
    }
    public function updateIntroducing(Request $request,$id){
        $name = $request->name;
        $content = $request->content;
        $timestart =$request->timestart;
        $timeend =$request->timeend;
        $values = array('name' => $name,'content' => $content,'timestart'=>$timestart,'timeend'=>$timeend);
        $query = DB::table('Introducing')->where('id', '=', $id)->update($values);
        if($query)
        {
            alert()->success('Update Successed');
        }
        return redirect()->route("homeIntroducing");
    }
    public function editIntroducing($id){
        $data = DB::select('select * from Introducing where id = ?', [$id]);
        if($data)
        {
            return view("introducing.update")->with("data",$data[0]);
        }
       
    }
    public function filterIntroducing(Request $request){
       $select = $request->select;
       $output="";
        if($select)
        {
            if($select=="Theo thứ tự giảm dần")
            {
                $data =  DB::table('Introducing')->orderBy('id', 'DESC')->paginate(5);
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
                $data =  DB::table('Introducing')->orderBy('name', 'ASC')->paginate(5);
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
    public function searchIntroducing(Request $request){
        $data =  DB::table('Introducing')->where('name', 'like', '%' . $request->search . '%')->paginate(5);
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
        
            $data = DB::table('Introducing')->paginate(5);
            if ($request->ajax()) {
                return view('introducing.data', compact('data'));
            }
            return view('introducing.index',compact('data'));
        
    }
}
