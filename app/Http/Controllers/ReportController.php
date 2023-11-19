<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;
use App\Models\Penduduk;

class ReportController extends Controller
{
    public function reportPendudukProvince()
    {
        $provinces = Province::all();

        $data = [];
        foreach ($provinces as $province) {
            $provinceId = $province->id;
            $penduduk = Penduduk::where('province_id', $provinceId)->get();
            $countPenduduk = count($penduduk);

            $data[] = [
                'province' => $province->name,
                'total' => $countPenduduk,
            ];
        }

        return view('report.penduduk_per_provinsi', compact('data', 'provinces'));
    }

    public function reportPendudukDistrict()
    {
        $provinces = Province::all();
        $districts = District::with('province')->get();

        $data = [];
        foreach ($districts as $district) {
            $districtId = $district->id;
            $penduduk = Penduduk::where('district_id', $districtId)->get();
            $countPenduduk = count($penduduk);

            $data[] = [
                'province' => $district->province->name,
                'district' => $district->name,
                'total' => $countPenduduk,
            ];
        }

        return view('report.penduduk_per_kabupaten', compact('data', 'provinces'));
    }
}
