<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest;
use App\Models\Grade;
use App\Models\Major;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = [
            'name' => $request->name,
            'major' => $request->major
        ];

        $grades = Grade::when($input['name'], function ($query) use ($input) {
            $query->where('name', 'like', '%' . $input['name'] . '%');
        })->whereHas('major', function ($query) use ($input) {
            $query->where('name', 'like', '%' . $input['major'] . '%');
        })->with('major')->paginate(10);

        return view('admin.kelas.index', compact('grades', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $majors = Major::get();

        return view('admin.kelas.create', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeRequest $request)
    {
        Grade::create($request->validated());

        return redirect(route('admin.kelas.index'))->with('success', 'Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->isMethod('GET')) {
            return abort(404, 'Method Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $majors = Major::get();

        return view('admin.kelas.edit', compact('grade', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grade = Grade::findOrFail($id);
        $grade->update([
            'name' => $request->name,
            'major_id' => $request->major_id
        ]);

        return redirect(route('admin.kelas.index'))->with('success', 'Kelas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Grade::destroy($id);

        return redirect(route('admin.kelas.index'))->with('success', 'Kelas berhasil dihapus');
    }
}
