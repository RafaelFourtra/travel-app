<?php

namespace App\Http\Controllers;

use App\Models\DataVaksin;
use App\Models\JamaahModel;
use Illuminate\Http\Request;

class DataVaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JamaahModel::select(['id', 'namajamaah'])->get();

        return view('vaksin.index', compact('data'));
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
            'jamaah_id' => 'required',
            'vaksin' => 'required',
            'tanggal' => 'required',
        ]);

        $query = DataVaksin::create([
            'jamaah_id' => $request->jamaah_id,
            'vaksin' => $request->vaksin,
            'tanggal' => $request->tanggal,
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
    public function show(DataVaksin $dataVaksin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DataVaksin::where('id', $id)->first();
        $query = JamaahModel::select(['id', 'namajamaah'])->get();

        return view('vaksin.edit', compact('data', 'query'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataVaksin $dataVaksin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $query = DataVaksin::where('id', $id)->delete();

        if ($query) {
            return response()->json(['success' => true]);
        }
    }

    public function get(Request $request)
    {
        $nama = $request->nama;
        $vaksin = $request->vaksin;

        $query = DataVaksin::with('jamaah');

        if ($nama) {
            $query->whereHas('jamaah', function ($subquery) use ($nama) {
                $subquery->where('namajamaah', 'LIKE', '%' . $nama . '%');
            });
        }

        if ($vaksin) {
            $query->where('tanggal', $vaksin);
        }

        $data = $query->get();

        return response()->json(compact('data'));
    }

    public function UpdateVaksin(Request $request, string $id)
    {
        $request->validate([
            'jamaah_id' => 'required',
            'vaksin' => 'required',
            'tanggal' => 'required',
        ]);

        $query = DataVaksin::where('id', $id)->update([
            'jamaah_id' => $request->jamaah_id,
            'vaksin' => $request->vaksin,
            'tanggal' => $request->tanggal,
        ]);

        if ($query) {
            return response()->json(['code' => 1]);
        } else {
            return response()->json(['code' => 0]);
        }
    }
}
