<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MajorRequest;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = [
            'name' => $request->name
        ];

        $majors = Major::paginate(10);
        $majors = Major::when($input['name'], function ($query) use ($input) {
            $query->where('name', 'like', '%' . $input['name'] . '%');
        })->paginate(10);

        return view('admin.jurusan.index', compact('majors', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MajorRequest $request)
    {
        Major::create($request->validated());

        return redirect(route('admin.jurusan.index'))->with('success', 'Jurusan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $major = Major::findOrFail($id);

        return view('admin.jurusan.edit', compact('major'));
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
        $major = Major::findOrFail($id);
        $major->update([
            'name' => $request->name
        ]);

        return redirect(route('admin.jurusan.index'))->with('success', 'Jurusan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Major::destroy($id);

        return redirect(route('admin.jurusan.index'))->with('success', 'Jurusan berhasil dihapus');
    }
}
