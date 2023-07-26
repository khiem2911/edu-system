<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Extracurricular;

class ExtracurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extracurricular = Extracurricular::paginate(5);
        return view('extracurriculars.index', ['extracurriculars' => $extracurricular]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('extracurriculars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //luu tru san pham
        //đọc thêm về validate
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpg,png|max:2048',
            'start_at' => 'required'
        ]);
        //upload
        $file = $request->file('photo');
        $destinationPath = 'admin/img';
        $fileName = $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);
        $extracurricular = new Extracurricular($request->all());
        $extracurricular->photo = $fileName;
        $extracurricular->save();
        return redirect()->route('extracurriculars.index')->with('success', 'Added successFully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $extra = Extracurricular::find($id);
        return view('extracurriculars.edit')->with('extra', $extra);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_at' => 'required'
        ]);
        // Product::create($request->all())->categories()->attach($request->input('categories'));
        $extra = new Extracurricular($request->all());
        $extra = Extracurricular::find($id);
        $extra->name = $request->input('name');
        $extra->description = $request->input('description');
        $extra->start_at = $request->input('start_at');
        if ($request->hasFile('photo')) {
            if (file_exists(public_path('admin/img/' . $extra->photo))) {
                unlink(public_path('admin/img/' . $extra->photo));
            }
            $file = $request->file('photo');
            $destinationPath = 'admin/img';
            $fileName = $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $extra->photo = $fileName;
        }
        $extra->save();
        return redirect()->route('extracurriculars.index')->with('success', 'Edited successFully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $extracurricular = Extracurricular::find($id);
        if (file_exists(public_path('admin/img/' . $extracurricular->photo))) {
            unlink(public_path('admin/img/' . $extracurricular->photo));
        }
        $extracurricular->delete();
        return redirect()->route('extracurriculars.index')->with('success', 'Delete successFully');
    }
    //Xóa theo checkbox
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Extracurricular::whereIn('id', $ids)->delete();
        return response()->json();
    }
    public function search(Request $request)
    {
        $query = Extracurricular::query();
        if ($request->ajax()) {
            $extras = $query
                ->where('name', 'like', '%' . $request->keyword . '%')
                ->orWhere('description', 'like', '%' . $request->keyword . '%')
                ->orWhere('start_at', 'like', '%' . $request->keyword . '%')
                ->get();
            return response()->json(['extracurriculars' => $extras]);
        } else {
            $extras = $query->get();
            return view('extracurriculars.index', ['extracurriculars' => $extras]);
        }
    }
    public function getSort(Request $request)
    {
        $sortBy = $request->input('sort_by');

        if ($sortBy === 'old') {
            $extras = Extracurricular::orderBy('start_at', 'asc')->get();
        } else if ($sortBy === 'new') {
            $extras = Extracurricular::orderBy('start_at', 'desc')->get();
        } else {
            $extras = Extracurricular::all();
        }
        return response()->json(['extracurriculars' => $extras]);
    }
}
