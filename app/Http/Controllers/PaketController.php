<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('paket.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga_paket' => 'required',
            'tgl_keberangkatan' => 'required',
        ]);

        $query = Paket::create([
            'nama' => $request->nama,
            'harga_paket' => $request->harga_paket,
            'tgl_keberangkatan' => $request->tgl_keberangkatan,
        ]);

        if ($query) {
            return response()->json(['code' => 1]);
        } else {
            return response()->json(['code' => 0]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Paket::where('id', $id)->first();

        return view('paket.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paket $paket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $query = Paket::where('id', $id)->delete();

        if ($query) {
            return response()->json(['success' => true]);
        }
    }

    public function get(Request $request)
    {
        $nama = $request->nama;
        $tglkeberangkatan = $request->tglkeberangkatan;

        $query = Paket::query();

        if ($nama) {
            $query->where('nama', 'LIKE', '%' . $nama . '%');
        }

        if ($tglkeberangkatan) {
            $query->where('tgl_keberangkatan', $tglkeberangkatan);
        }

        $data = $query->get();

        return response()->json(compact('data'));
    }

    public function UpdatePaket(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'harga_paket' => 'required',
            'tgl_keberangkatan' => 'required',
        ]);

        $query = Paket::where('id', $id)->update([
            'nama' => $request->nama,
            'harga_paket' => $request->harga_paket,
            'tgl_keberangkatan' => $request->tgl_keberangkatan,
        ]);

        if ($query) {
            return response()->json(['code' => 1]);
        } else {
            return response()->json(['code' => 0]);
        }
    }
}
