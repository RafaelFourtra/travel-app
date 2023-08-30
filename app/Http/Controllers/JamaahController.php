<?php

namespace App\Http\Controllers;

use App\Models\JamaahModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JamaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jamaah/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jamaah/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nij' => 'required',
            'namajamaah' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required|numeric|digits:16',
            'no_passport' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'keterangan' => 'required',
        ]);

        $userId = Auth::id();
        $query = JamaahModel::create([
            'user_id' => $userId,
            'nij' => $request->nij,
            'namajamaah' => $request->namajamaah,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_passport' => $request->no_passport,
            'no_hp' => $request->no_hp,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'keterangan' => $request->keterangan,
        ]);

        if ($query) {
            return redirect()->to('jamaah');
        }
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
        $query = JamaahModel::where('id', $id)->first();

        if ($query) {
            return view('jamaah.edit', compact('query'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nij' => 'required',
            'namajamaah' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required|numeric|digits:16',
            'no_passport' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'keterangan' => 'required',
        ]);

        $userId = Auth::id();
        $query = JamaahModel::where('id', $id)->update([
            'user_id' => $userId,
            'nij' => $request->nij,
            'namajamaah' => $request->namajamaah,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_passport' => $request->no_passport,
            'no_hp' => $request->no_hp,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'keterangan' => $request->keterangan,
        ]);

        if ($query) {
            return redirect()->to('jamaah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $query = JamaahModel::where('id', $id)->delete();

        if ($query) {
            return response()->json(['success' => true]);
        }
    }

    public function get(Request $request)
    {
        $nama = $request->nama;
        $tgllahir = $request->tgllahir;

        $query = JamaahModel::query();

        if ($nama) {
            $query->where('namajamaah', 'LIKE', '%' . $nama . '%');
        }

        if ($tgllahir) {
            $query->where('tgl_lahir', $tgllahir);
        }

        $data = $query->get();

        foreach ($data as $item) {
            $item->umur = now()->diffInYears($item->tgl_lahir);
        }

        return response()->json(compact('data'));
    }
}
