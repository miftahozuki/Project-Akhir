<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
            'role' => $request->has('role') ? $request->role : '',
        ];

        $users = User::when($input['name'], function ($query) use ($input) {
            $query->where('name', 'like', '%' . $input['name'] . '%');
        })->when($input['email'], function ($query) use ($input) {
            $query->orWhere('email', 'like', '%' . $input['email'] . '%');
        })->when($input['role'], function ($query) use ($input) {
            $query->orWhere('role', 'like', '%' . $input['role'] . '%');
        })->where('role', '!=', 'siswa')->paginate(10);

        return view('admin.user.index', compact('users', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect(route('admin.user.index'))->with('success', 'User berhasil ditambahkan');
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
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => is_null($request->password) ? $user->password : $request->password,
            'role' => $request->role,
        ]);

        return redirect(route('admin.user.index'))->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect(route('admin.user.index'))->with('success', 'User berhasil dihapus');
    }
}
