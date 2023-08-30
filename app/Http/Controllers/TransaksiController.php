<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiModel;
use App\Models\JamaahModel;
use App\Models\Paket;
use App\Models\TransaksiModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jamaah = JamaahModel::select(['id', 'namajamaah'])->get();
        $paket = Paket::select(['id', 'nama', 'harga_paket'])->get();
        $transaksi = TransaksiModel::select(['id', 'kode_transaksi', 'namajamaah', 'harga_paket', 'saldo'])->where('is_lunas', 0)->get();

        return view('transaksi.index', compact('jamaah', 'paket', 'transaksi'));
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
            'paket_id' => 'required',
            'namajamaah' => 'required',
            'harga_paket' => 'required',
            'keterangan' => 'required',
        ]);

        if ($request->pembayaran > $request->harga_paket) {
            return response()->json(['code' => 0]);
        } else {
            $no = TransaksiModel::whereDate('created_at', Carbon::today())->count();
            $no++;
            $kode_transaksi = date('ymd') . str_pad($no, 3, 0, STR_PAD_LEFT);
            $sisapembayaran = $request->harga_paket - $request->pembayaran;
            $saldo = $request->pembayaran;
            $is_lunas = 0;

            if ($request->harga_paket === $request->pembayaran) {
                $is_lunas = 1;
                $saldo = 0;
            }

            $query = TransaksiModel::create([
                'kode_transaksi' => $kode_transaksi,
                'jamaah_id' => $request->jamaah_id,
                'paket_id' =>  $request->paket_id,
                'namajamaah' => $request->namajamaah,
                'harga_paket' => $request->harga_paket,
                'saldo' => $saldo,
                'is_lunas' => $is_lunas,
                'keterangan' => $request->keterangan,
                'tanggal_transaksi' => date('Y-m-d H:i:s')
            ]);


            $query2 = DetailTransaksiModel::create([
                'transaksi_id' => $query->id,
                'pembayaran' => $request->pembayaran,
                'sisa_pembayaran' =>  $sisapembayaran
            ]);

            if ($query && $query2) {
                return response()->json(['code' => 1]);
            } else {
                return response()->json(['code' => 0]);
            }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function pelunasan(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required',
            'pembayaran' => 'required',
            'sisa_pembayaran' => 'required',
        ]);
        if ($request->pembayaran > $request->jumlah_pelunasan) {
            return response()->json(['code' => 0]);
        } else {
            $query = DetailTransaksiModel::create([
                'transaksi_id' => $request->transaksi_id,
                'pembayaran' => $request->pembayaran,
                'sisa_pembayaran' => $request->sisa_pembayaran
            ]);

            $saldo = $request->saldo_old + $request->pembayaran;
            if ($request->sisa_pembayaran === "0") {
                $saldo = 0;
                TransaksiModel::where('id', $request->transaksi_id)
                    ->update([
                        'is_lunas' => 1,
                        'saldo' => $saldo
                    ]);
            } else {
                TransaksiModel::where('id', $request->transaksi_id)
                    ->update([
                        'saldo' => $saldo
                    ]);
            }

            if ($query) {
                return response()->json(['code' => 1]);
            } else {
                return response()->json(['code' => 0]);
            }
        }
    }

    public function get(Request $request)
    {
        $nama = $request->nama;
        $kodetransaksi = $request->kodetransaksi;
        $tgltransaksi = $request->tgltransaksi;

        $query = TransaksiModel::with(['jamaah', 'paket']);

        if ($nama) {
            $query->whereHas('jamaah', function ($subquery) use ($nama) {
                $subquery->where('namajamaah', 'LIKE', '%' . $nama . '%');
            });
        }

        if ($kodetransaksi) {
            $query->where('kode_transaksi', $kodetransaksi);
        }

        if ($tgltransaksi) {
            $query->where('tanggal_transaksi', $tgltransaksi);
        }

        $data = $query->get();

        return response()->json(compact('data'));
    }
}
