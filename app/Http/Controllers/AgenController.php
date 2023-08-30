<?php

namespace App\Http\Controllers;

use App\Models\AgenModel;
use Illuminate\Http\Request;

class AgenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('agen/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agen/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nia' => 'required',
            'namaagen' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required|numeric|digits:16',
            'no_passport' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'keterangan' => 'required',
            'jumlah_jamaah' => 'required|numeric',
            'fee_jamaah' => 'required|numeric',
            'jumlah_saldo' => 'required|numeric',
        ]);

        $query = AgenModel::create([
            'nia' => $request->nia,
            'namaagen' => $request->namaagen,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_passport' => $request->no_passport,
            'no_hp' => $request->no_hp,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'keterangan' => $request->keterangan,
            'jumlah_jamaah' => $request->jumlah_jamaah,
            'fee_jamaah' => $request->fee_jamaah,
            'jumlah_saldo' => $request->jumlah_saldo,
        ]);
      
        if ($query) {
            return redirect()->to('agen');
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
        $query = AgenModel::where('id', $id)->first();

        if ($query) {
            return view('agen.edit', compact('query'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nia' => 'required',
            'namaagen' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required|numeric|digits:16',
            'no_passport' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'keterangan' => 'required',
            'jumlah_jamaah' => 'required|numeric',
            'fee_jamaah' => 'required|numeric',
            'jumlah_saldo' => 'required|numeric',
        ]);

        $query = AgenModel::where('id', $id)->update([
            'nia' => $request->nia,
            'namaagen' => $request->namaagen,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_passport' => $request->no_passport,
            'no_hp' => $request->no_hp,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'keterangan' => $request->keterangan,
            'jumlah_jamaah' => $request->jumlah_jamaah,
            'fee_jamaah' => $request->fee_jamaah,
            'jumlah_saldo' => $request->jumlah_saldo,
        ]);

        if ($query) {
            return redirect()->to('agen');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $query = AgenModel::where('id', $id)->delete();

        if ($query) {
            return response()->json(['success' => true]);
        }
    }

    public function get(Request $request)
    {
        $nama = $request->nama;
        $tgllahir = $request->tgllahir;

        $query = AgenModel::query();

        if ($nama) {
            $query->where('namaagen', 'LIKE', '%' . $nama . '%');
        }

        if ($tgllahir) {
            $query->where('tgl_lahir', $tgllahir);
        }

        $data = $query->get();

        return response()->json(compact('data'));
    }
}
