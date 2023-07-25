<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class EssayController extends Controller
{
    public function deleteAllEssay(Request $request)
    {
        $id = $request->checkbox;
        $alert;
        if ($id == null) {
            $count = DB::table('Essay')->count();
            if ($count == 0) {
                $alert = alert()->warning('Nothing to delete');
                return redirect()->route('homeEssay', ['alert' => $alert]);
            } else {
                DB::table('Essay')->delete();
                $alert = alert()->success('Delete Successed');
                return redirect()->route('homeEssay', ['alert' => $alert]);
            }
            $alert = alert()->warning('Please select at least 1 to delete');
            return redirect()->route('homeEssay', ['alert' => $alert]);
        } else {
            foreach ($id as $item) {
                $deleted = DB::table('Essay')
                    ->where('id', '=', $item)
                    ->delete();
            }
            if ($deleted) {
                alert()->success('Delete Successed');
                return redirect()->route('homeEssay');
            }
        }
    }
    public function addEssay(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $essaytitle = $request->essaytitle;
        $content = $request->content;
        $query = false;

        $request->session()->flush();
        $values = ['name' => $name, 'address' => $address, 'essaytitle' => $essaytitle, 'content' => $content];
        $request->session()->reflash();
        $query = DB::table('Essay')->insert($values);
        $data = DB::table('Essay')->paginate(5);
        $html = view('essay.data', compact('data'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
        ]);
    }
    public function deleteEssay(Request $request)
    {
        $deleted = DB::table('Essay')
            ->where('id', '=', $request->id)
            ->delete();
        $data = DB::table('Essay')->paginate(5);
        $html = view('essay.data', compact('data'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
        ]);
    }
    public function updateEssay(Request $request, $id)
    {
        $name = $request->name;
        $address = $request->address;
        $essaytitle = $request->essaytitle;
        $content = $request->content;
        $values = ['name' => $name, 'address' => $address, 'essaytitle' => $essaytitle, 'content' => $content];
        $query = DB::table('Essay')
            ->where('id', '=', $id)
            ->update($values);
        if ($query) {
            alert()->success('Update Successed');
        }
        return redirect()->route('homeEssay');
    }
    public function editEssay($id)
    {
        $data = DB::select('select * from Essay where id = ?', [$id]);
        if ($data) {
            return view('Essay.update')->with('data', $data[0]);
        }
    }
    public function filterEssay(Request $request)
    {
        $select = $request->select;
        $output = '';
        if ($select) {
            if ($select == 'Theo thứ tự giảm dần') {
                $data = DB::table('Essay')
                    ->orderBy('id', 'DESC')
                    ->paginate(5);
                $output = '';
                foreach ($data as $item) {
                    $output .=
                        '
                    <tr>
                    <td class="text-center align-middle"><input name="id[]" type="checkbox" id="checkItem"value=' .$item->id .'>
                    <td class="align-middle"> ' .$item->id .' </td>
                    <td class="align-middle"> ' .$item->name .' </td>
                    <td class="align-middle"> ' .$item->address .' </td>
                    <td class="align-middle"> ' .$item->essaytitle .' </td>
                    <td class="align-middle"> ' .$item->content .' </td>
                    <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                         <a  href="/editEssay/' .$item->id .'" class="btn btn-warning">Edit</a>
                         <a id="deleteBtn" href="checkDelete/' .$item->id .'" class="btn btn-danger">Delete</a>
                    </div>
                 </td>
                    </tr>
                    ';
                }
                return response($output);
            }
            if ($select == 'A tới Z') {
                $data = DB::table('Essay')
                    ->orderBy('name', 'ASC')
                    ->paginate(5);
                $output = '';
                foreach ($data as $item) {
                    $output .=
                        '
                    <tr>
                    <td class="text-center align-middle"><input name="id[]" type="checkbox" id="checkItem"value=' .$item->id .'>
                    <td class="align-middle"> ' .$item->id .' </td>
                    <td class="align-middle"> ' .$item->name .' </td>
                    <td class="align-middle"> ' .$item->address .' </td>
                    <td class="align-middle"> ' .$item->essaytitle .' </td>
                    <td class="align-middle"> ' .$item->content .' </td>
                    <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                         <a  href="/editEssay/' .
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
    public function searchEssay(Request $request)
    {
        $data = DB::table('Essay')
            ->where('name', 'like', '%' . $request->search . '%')
            ->paginate(5);
        $output = '';
        foreach ($data as $item) {
            $output .=
                '
            <tr>
            <td class="text-center align-middle"><input name="id[]" type="checkbox" id="checkItem" value=' . $item->id .'>
            <td class="align-middle"> ' . $item->id .' </td>
            <td class="align-middle"> ' . $item->name .' </td>
            <td class="align-middle"> ' . $item->address .' </td>
            <td class="align-middle"> ' . $item->essaytitle .' </td>
            <td class="align-middle"> ' . $item->content .' </td>
            <td class="align-middle">
            <div class="btn-group" role="group" aria-label="Basic example">
                 <a  href="/EditEssay/' . $item->id .'" class="btn btn-warning">Edit</a>
                 <a id="deleteBtn" href="checkDelete/' . $item->id .'" class="btn btn-danger">Delete</a>
            </div>
         </td>
            </tr>
            ';
        }
        return response($output);
    }
    public function sortEssay(Request $request)
    {
        if ($request->ajax()) {
            $sortType = $request->sortby;
            $sortBy = $request->columnName;
            $data = DB::table('Essay')
                ->orderBy($sortBy, $sortType)
                ->paginate(5);
            $output = '';
            foreach ($data as $item) {
                $output .=
                    '
            <tr>
            <td class="text-center align-middle"><input name="id[]" type="checkbox" id="checkItem" value=' . $item->id . '>
                    <td class="align-middle"> ' . $item->id . ' </td>
                <td class="align-middle"> ' . $item->name . ' </td>
                <td class="align-middle"> ' . $item->address . ' </td>
                <td class="align-middle"> ' . $item->essaytitle . ' </td>
                <td class="align-middle"> ' . $item->content . ' </td>
            <td class="align-middle">
            <div class="btn-group" role="group" aria-label="Basic example">
                 <a  href="/EditSer/' . $item->id . '" class="btn btn-warning">Edit</a>
                 <a id="deleteBtn" href="checkDelete/' . $item->id . '" class="btn btn-danger">Delete</a>
            </div>
         </td>
            </tr>
            ';
            }
            return response($output);
        }
    }
    public function loadData(Request $request)
    {
        $data = DB::table('Essay')->paginate(5);
        if ($request->ajax()) {
            return view('essay.data', compact('data'));
        }
        return view('essay.index', compact('data'));
    }
}
