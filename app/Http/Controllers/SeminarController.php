<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;
class SeminarController extends Controller
{
    public function deleteAllSeminar(Request $request)
    {
        $id = $request->checkbox;
        $alert;
        if ($id == null) {
            $count = DB::table('seminar')->count();
            if ($count == 0) {
                $alert = alert()->warning('Nothing to delete');
                return redirect()->route('homeSerminar', ['alert' => $alert]);
            } else {
                DB::table('seminar')->delete();
                $alert = alert()->success('Delete Successed');
                return redirect()->route('homeSerminar', ['alert' => $alert]);
            }
            $alert = alert()->warning('Please select at least 1 to delete');
            return redirect()->route('homeSerminar', ['alert' => $alert]);
        } else {
            foreach ($id as $item) {
                $deleted = DB::table('seminar')
                    ->where('id', '=', $item)
                    ->delete();
            }
            if ($deleted) {
                alert()->success('Delete Successed');
                return redirect()->route('homeSerminar');
            }
        }
    }
    public function fetch_seminar(Request $request)
    {
        if($request->ajax())
        {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $data = DB::table('seminar')
                ->orderBy($sort_by, $sort_type)
                ->paginate(5);
            return view('seminar.pagination', compact('data'))->render();
        }
    }
    public function addSeminar(Request $request)
    {
        $name = $request->name;
        $content = $request->content;
        $timestart = $request->timestart;
        $timeend = $request->timeend;
        $query = false;

        $request->session()->flush();
        $values = ['name' => $name, 'content' => $content, 'timestart' => $timestart, 'timeend' => $timeend];
        $request->session()->reflash();
        $query = DB::table('seminar')->insert($values);
        $data = DB::table('seminar')->paginate(5);
        $html = view('seminar.data', compact('data'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
        ]);
    }
    public function deleteSeminar(Request $request)
    {
        $deleted = DB::table('seminar')
            ->where('id', '=', $request->id)
            ->delete();
        $data = DB::table('seminar')->paginate(5);
        $html = view('seminar.data', compact('data'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
        ]);
    }
    public function updateSeminar(Request $request)
    {
        $name = $request->get('name');
        $content = $request->get('content');
        $timestart = $request->get('timestart');
        $timeend = $request->get('timeend');
        $id = $request->get('id');
        if($name==null||$content==null||$timestart==null||$timeend==null){
            return response()->json([
                'status' => false,
            ]);
        }else
        {
        $values = ['name' => $name, 'content' => $content, 'timestart' => $timestart, 'timeend' => $timeend];
        $query = DB::table('seminar')
            ->where('id', '=', $id)
            ->update($values);
        if ($query) {
            return response()->json([
                'status' => true,
            ]);
        };
    }
    }
    public function editSeminar($id)
    {
        $data = DB::select('select * from seminar where id = ?', [$id]);
        if ($data) {
            return view('seminar.update')->with('data', $data[0]);
        }
    }
    public function filterSeminar(Request $request)
    {
        $select = $request->select;
        $output = '';
        if ($select) {
            if ($select == 'Theo thứ tự ID giảm dần') {
                $data = DB::table('seminar')
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
                         <a  href="/EditSer/' .
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
            if ($select == 'A tới Z(Name Seminar)') {
                $data = DB::table('seminar')
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
                         <a  href="/EditSer/' .
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
    public function searchSeminar(Request $request)
    {
        $data = DB::table('seminar')
            ->where('name', 'like', '%' . $request->search . '%')
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
                 <a  href="/EditSer/' .
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
    public function sortSeminar(Request $request)
    {
        if ($request->ajax()) {
            $sortType = $request->sortby;
            $sortBy = $request->columnName;
            $data = DB::table('seminar')
                ->orderBy($sortBy, $sortType)
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
                 <a  href="/EditSer/' .
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
    public function loadData(Request $request)
    {
        $data = DB::table('seminar')
            ->orderBy('id', 'asc')
            ->paginate(5);
        if($request->ajax()){
            return view('seminar.data', compact('data'));
        }
        return view('seminar.index', compact('data'));
    }
}
