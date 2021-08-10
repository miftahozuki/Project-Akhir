<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Grade;
use App\Models\StudentDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = [
            'name' => $request->has('name') ? $request->name : '',
            'email' => $request->has('email') ? $request->email : '',
        ];

        $students = User::when($input['name'], function ($query) use ($input) {
            $query->where('name', 'like', '%' . $input['name'] . '%');
        })->when($input['email'], function ($query) use ($input) {
            $query->orWhere('email', 'like', '%' . $input['email'] . '%');
        })->with(['detail'])->where('role', 'siswa')->paginate(10);

        return view('admin.Mahasiswa.index', compact('students', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::get();

        return view('admin.Mahasiswa.create', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        DB::beginTransaction();
        try {
            $student = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'role'      => 'siswa'
            ]);

            StudentDetail::create([
                'user_id'       => $student->id, // Mengambil last insert id dari $student
                'grade_id'      => $request->grade,
                'nim'           => $request->nim,
                'tahun_masuk'   => $request->tahun_masuk,
                'address'       => $request->address,
                'phone'         => $request->phone,
            ]);

            DB::commit();
            return redirect(route('admin.mahasiswa.index'))->with('success', 'Mahasiswa berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('admin.mahasiswa.index'))->with('danger', 'Mahasiswa gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = User::with(['detail'])->findOrFail($id);

        return view('admin.mahasiswa.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = User::with(['detail'])->findOrFail($id);
        $grades = Grade::with(['major'])->get();

        return view('admin.mahasiswa.edit', compact('student', 'grades'));
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
        DB::beginTransaction();
        try {
            $student = User::findOrFail($id);

            $student->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? bcrypt($request->password) : $student->password
            ]);

            StudentDetail::where('user_id', $id)->update([
                'nim' => $request->nim,
                'tahun_masuk' => $request->tahun_masuk,
                'address' => $request->address,
                'phone' => $request->phone
            ]);
            DB::commit();
            return redirect(route('admin.mahasiswa.index'))->with('success', 'Mahasiswa berhasil diubah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('admin.mahasiswa.index'))->with('danger', 'Mahasiswa gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            User::destroy($id);

            DB::commit();
            return redirect(route('admin.mahasiswa.index'))->with('success', 'Mahasiswa berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('admin.mahasiswa.index'))->with('danger', 'Mahasiswa gagal dihapus');
        }
    }
}
