<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $viewIndex = 'users';
    private $viewCreate = 'users_form';
    private $viewedit = 'users_form';
    private $viewShow = 'users_show';
    private $routePrefix = 'user';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->latest()->paginate(5);

        return view('admin.' . $this->viewIndex, compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'model' => new User(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'Simpan',

        ];

        return view('admin.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requesData = $request->validate([
            'name' => 'required',
            'email' => 'required | unique:users',
            'phone' => 'required | unique:users',
            'role' => 'required | in:admin,petugas',
            'password' => 'required | min:8',
        ]);
        $requesData['password'] = bcrypt($requesData['password']);
        User::create($requesData);
        flash('Data User Berhasilsukses Ditambahkan')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = User::findOrFail($id);
        // return view('admin.' . $this->viewShow, compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'model' => User::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'Update',

        ];

        return view('admin.' . $this->viewedit, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requesData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'role' => 'required|in:admin,petugas',
            'password' => 'nullable | min:8',
        ]);
        $users = User::findOrFail($id);
        if (isset($requesData['password']) == "") {
            unset($requesData['password']);
        } else {
            $requesData['password'] = bcrypt($requesData['password']);
        }
        $users->fill($requesData)->save();
        flash('Data User Berhasil Dirubah')->success();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = User::findOrFail($id);
        if ($model->email == 'admin@gmail.com') {
            flash('Data User Tidak Bisa Dihapus')->error();
            return back();
        }

        $model->delete();
        flash('Data User Berhasilsukses Dihapus')->success();
        return back();
    }
}
