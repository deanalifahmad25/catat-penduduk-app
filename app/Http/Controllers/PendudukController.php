<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\Province;
use App\Models\District;

class PendudukController extends Controller
{
    public function index()
    {
        $data = Penduduk::with(['province', 'district'])->get();
        $provinces = Province::all();

        return view('welcome', compact('data', 'provinces'));
    }

    public function create()
    {
        $provinces = Province::all();

        return view('create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nik' => 'required|max:18',
            'gender' => 'required',
            'date_birth' => 'required|date',
            'address' => 'required',
            'province' => 'required',
            'district' => 'required',
        ]);

        $data = Penduduk::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'gender' => $request->gender,
            'date_birth' => $request->date_birth,
            'address' => $request->address,
            'province_id' => $request->province,
            'district_id' => $request->district,
        ]);

        return redirect()->route('penduduk');
    }

    public function edit($id)
    {
        $penduduk = Penduduk::where('id', $id)->first();
        $provinces = Province::all();

        return view('edit', compact('penduduk', 'provinces'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nik' => 'required|max:18',
            'gender' => 'required',
            'date_birth' => 'required|date',
            'address' => 'required',
            'province' => 'required',
            'district' => 'required',
        ]);

        Penduduk::where('id', $id)->update([
            'name' => $request->name,
            'nik' => $request->nik,
            'gender' => $request->gender,
            'date_birth' => $request->date_birth,
            'address' => $request->address,
            'province_id' => $request->province,
            'district_id' => $request->district,
        ]);

        return redirect()->route('penduduk');
    }

    public function destroy($id)
    {
        $penduduk = Penduduk::where('id', $id)->first();

        $penduduk->delete();

        return redirect()->route('penduduk');
    }

    public function getDistrict(Request $request)
    {
        $provinceId = $request->input('province_id');
        $districts = District::where('province_id', $provinceId)->get();

        return response()->json($districts);
    }

    public function getFilteredData(Request $request)
    {
        $provinceId = $request->input('province_id');
        $districtId = $request->input('district_id');

        $query = Penduduk::query()->with('province', 'district');

        if ($provinceId) {
            $query->where('province_id', $provinceId);
        }

        if ($districtId) {
            $query->where('district_id', $districtId);
        }

        $filteredData = $query->get();

        $data = [];
        foreach ($filteredData as $penduduk) {
            $editLink = '<a href="' . route('edit.penduduk', $penduduk->id) . '" class="btn btn-link btn-sm btn-rounded">Edit</a>';
            $deleteForm = '<form method="post" action="' . route('delete.penduduk', $penduduk->id) . '">' . csrf_field() . method_field('delete') . '<button type="submit" class="btn btn-link btn-sm btn-rounded text-danger">Hapus</button></form>';

            $data[] = [
                $penduduk->id,
                $editLink . $deleteForm,
                $penduduk->name,
                $penduduk->nik,
                date('d F Y', strtotime($penduduk->date_birth)),
                $penduduk->address . ', ' . $penduduk->district->name . ', ' . $penduduk->province->name,
                $penduduk->gender,
                date('Y-m-d-H:i:s', strtotime($penduduk->updated_at))
            ];
        }

        return response()->json(['data' => $data]);
    }
}
