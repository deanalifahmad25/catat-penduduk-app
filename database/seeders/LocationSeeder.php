<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\District;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [['name' => 'Jawa Barat'], ['name' => 'Jawa Tengah'], ['name' => 'Jawa Timur'], ['name' => 'Daerah Istimewa Yogyakarta']];

        $districts = [
            [
                'name' => 'Kab. Bandung',
                'province_id' => 1,
            ],
            [
                'name' => 'Kab. Bekasi',
                'province_id' => 1,
            ],
            [
                'name' => 'Kab. Bogor',
                'province_id' => 1,
            ],
            [
                'name' => 'Kab. Ciamis',
                'province_id' => 1,
            ],
            [
                'name' => 'Kab. Cianjur',
                'province_id' => 1,
            ],
            [
                'name' => 'Kab. Cirebon',
                'province_id' => 1,
            ],
            [
                'name' => 'Kab. Garut',
                'province_id' => 1,
            ],
            [
                'name' => 'Kab. Karawang',
                'province_id' => 1,
            ],
            [
                'name' => 'Kab. Kuningan',
                'province_id' => 1,
            ],
            [
                'name' => 'Kab. Sukabumi',
                'province_id' => 1,
            ],
            [
                'name' => 'Kab. Tasikmalaya',
                'province_id' => 1,
            ],
            [
                'name' => 'Kab. Sumedang',
                'province_id' => 1,
            ],
            [
                'name' => 'Kab. Banjarnegara',
                'province_id' => 2,
            ],
            [
                'name' => 'Kab. Banyumas',
                'province_id' => 2,
            ],
            [
                'name' => 'Kab. Batang',
                'province_id' => 2,
            ],
            [
                'name' => 'Kab. Brebes',
                'province_id' => 2,
            ],
            [
                'name' => 'Kab. Cilacap',
                'province_id' => 2,
            ],
            [
                'name' => 'Kab. Magelang',
                'province_id' => 2,
            ],
            [
                'name' => 'Kab. Semarang',
                'province_id' => 2,
            ],
            [
                'name' => 'Kab. Bangkalan',
                'province_id' => 3,
            ],
            [
                'name' => 'Kab. Banyuwangi',
                'province_id' => 3,
            ],
            [
                'name' => 'Kab. Kediri',
                'province_id' => 3,
            ],
            [
                'name' => 'Kab. Ngawi',
                'province_id' => 3,
            ],
            [
                'name' => 'Kab. Pacitan',
                'province_id' => 3,
            ],
            [
                'name' => 'Kab. Pasuruan',
                'province_id' => 3,
            ],
            [
                'name' => 'Kab. Tulungagung',
                'province_id' => 3,
            ],
            [
                'name' => 'Kab. Bantul',
                'province_id' => 4,
            ],
            [
                'name' => 'Kab. Gunungkidul',
                'province_id' => 4,
            ],
            [
                'name' => 'Kab. Kulon Progo',
                'province_id' => 4,
            ],
            [
                'name' => 'Kab. Sleman',
                'province_id' => 4,
            ],
            [
                'name' => 'Kota Yogyakarta',
                'province_id' => 4,
            ],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }

        foreach ($districts as $district) {
            District::create($district);
        }
    }
}
