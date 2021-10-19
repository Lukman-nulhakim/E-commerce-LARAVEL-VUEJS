<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class RajaOngkirController extends Controller
{
    public function getProvinces()
    {
        $provinces = Province::all();
        return response()->json([
            'success' => true,
            'message' => 'List Data Provinces',
            'data' => $provinces
        ]);
    }

    public function getCities(Request $request)
    {
        $city = City::where('province_id', $request->province_id)->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data Cities By Province',
            'data' => $city
        ]);
    }

    public function checkOngkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => $request->origin,     // ID kota/kabupaten asal, 113 adalah kode kota demak
            'destination'   => $request->city_destination,      // ID kota/kabupaten tujuan
            'weight'        => $request->weight,    // berat barang dalam gram
            'courier'       => $request->courier    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Cost All Courier'. $request->courier,
            'data' => $cost
        ]);
    }
}
