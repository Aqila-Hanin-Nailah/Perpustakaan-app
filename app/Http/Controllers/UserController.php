<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $Users = User::where('name', 'LIKE', '%'.$request->cari.'%')->simplePaginate(5)->appends($request->all());
        // dd($Users);
        return view('pages.kelola_akses', compact('Users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('akses.tambah_akses');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'activities' => 'required'
        ]);

        $userActiv = User::create([
            'name' => $request->name,
            'role' => $request->role,
            'activities' => $request->activities
        ]);
        return redirect()->route('kelola_akses.user.index')->with('success', 'Berhasil menambahkan User!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::find($id);
        return view('akses.edit_akses', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'activities' => 'required'
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'role' => $request->role,
            'activities' => $request->activities
        ]);

        return redirect()->route('kelola_akses.user.index')->with('success', 'Berhasil mengubah data Akses!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data User!');
    }
}
