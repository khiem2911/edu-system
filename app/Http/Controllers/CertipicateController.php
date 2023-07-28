<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;
class CertipicateController extends Controller
{
    public function deleteAllCertipicate(Request $request)
    {
        $id = $request->checkbox;
        $alert;
        if ($id == null) {
            $count = DB::table('card_activation')->count();
            if ($count == 0) {
                $alert = alert()->warning('Nothing to delete');
                return redirect()->route('homeCertipicate', ['alert' => $alert]);
            } else {
                DB::table('card_activation')->delete();
                $alert = alert()->success('Delete Successed');
                return redirect()->route('homeCertipicate', ['alert' => $alert]);
            }
            $alert = alert()->warning('Please select at least 1 to delete');
            return redirect()->route('homeCertipicate', ['alert' => $alert]);
        } else {
            foreach ($id as $item) {
                $deleted = DB::table('card_activation')
                    ->where('id', '=', $item)
                    ->delete();
            }
            if ($deleted) {
                alert()->success('Delete Successed');
                return redirect()->route('homeCertipicate');
            }
        }
    }
    public function addCertipicate(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $dateofbirth = $request->get("dateofbidth");
        $phone = $request->phone;
        $email = $request->email;
        $query = false;

        $request->session()->flush();
        $values = ['name' => $name, 'address' => $address, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'email' => $email];
        $request->session()->reflash();
        $query = DB::table('card_activation')->insert($values);
        $data = DB::table('card_activation')->paginate(5);
        $html = view('certipicate.data', compact('data'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
        ]);
    }
    public function deleteCertipicate(Request $request)
    {
        $deleted = DB::table('Card_activation')
            ->where('id', '=', $request->id)
            ->delete();
        $data = DB::table('Card_activation')->paginate(5);
        $html = view('certipicate.data', compact('data'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
        ]);
    }
    public function updateCertipicate(Request $request, $id)
    {
        $name = $request->name;
        $address = $request->address;
        $dateofbirth = $request->dateofbirth;
        $phone = $request->phone;
        $email = $request->email;
        $values = ['name' => $name, 'address' => $address, 'dateofbirth' => $dateofbirth, 'phone' => $phone, 'email' => $email];
        $query = DB::table('card_activation')
            ->where('id', '=', $id)
            ->update($values);
        if ($query) {
            alert()->success('Update Successed');
        }
        return redirect()->route('homeCertipicate');
    }
    public function editCertipicate($id)
    {
        $data = DB::select('select * from card_activation where id = ?', [$id]);
        if ($data) {
            return view('certipicate.update')->with('data', $data[0]);
        }
    }
    public function filterCertipicate(Request $request)
    {
        $select = $request->select;
        $output = '';
        if ($select) {
            if ($select == 'Theo thứ tự giảm dần') {
                $data = DB::table('card_activation')
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
                        $item->address .
                        ' </td>
                    <td class="align-middle"> ' .
                        $item->dateofbirth .
                        ' </td>
                    <td class="align-middle"> ' .
                        $item->phone .
                        ' </td>
                        <td class="align-middle"> ' .
                        $item->email .
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
            if ($select == 'A tới Z') {
                $data = DB::table('card_activation')
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
                        $item->address .
                        ' </td>
                    <td class="align-middle"> ' .
                        $item->dateofbirth .
                        ' </td>
                    <td class="align-middle"> ' .
                        $item->phone .
                        ' </td>
                        <td class="align-middle"> ' .
                        $item->email .
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
    public function searchCertipicate(Request $request)
    {
        $data = DB::table('card_activation')
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
                $item->address .
                ' </td>
            <td class="align-middle"> ' .
                $item->dateofbirth .
                ' </td>
            <td class="align-middle"> ' .
                $item->phone .
                ' </td>
                <td class="align-middle"> ' .
                $item->email .
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
    public function sortCertipicate(Request $request)
    {
        if ($request->ajax()) {
            $sortType = $request->sortby;
            $sortBy = $request->columnName;
            $data = DB::table('card_activation')
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
                    $item->address .
                    ' </td>
            <td class="align-middle"> ' .
                    $item->dateofbirth .
                    ' </td>
            <td class="align-middle"> ' .
                    $item->phone .
                    ' </td>
                    <td class="align-middle"> ' .
                    $item->email .
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
        $data = DB::table('card_activation')->paginate(5);
        if ($request->ajax()) {
            return view('certipicate.data', compact('data'));
        }
        return view('certipicate.index', compact('data'));
    }
}
