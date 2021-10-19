<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinceRow) {
            Province::create([
                'province_id' => $provinceRow['province_id'],
                'name' => $provinceRow['province'],
            ]);
            $daftarKota = RajaOngkir::kota()->dariProvinsi($provinceRow['province_id'])->get();
            foreach ($daftarKota as $cityRow ) {
                City::create([
                    'province_id' => $provinceRow['province_id'],
                    'city_id' => $cityRow['city_id'],
                    'name' => $cityRow['city_name'],
                ]);
            }
        }
    }
}
