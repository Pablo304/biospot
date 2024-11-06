<?php

namespace Database\Seeders;

use App\Models\Address\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipios = [
            'Alto Alegre',
            'Amajari',
            'Boa Vista',
            'Bonfim',
            'Cantá',
            'Caracaraí',
            'Caroebe',
            'Iracema',
            'Mucajaí',
            'Normandia',
            'Pacaraima',
            'Rorainópolis',
            'São João da Baliza',
            'São Luiz',
            'Uiramutã',
        ];

        foreach ($municipios as $municipio) {
            Location::firstOrCreate([
                'slug' => Str::slug($municipio),
            ], [
                'name' => $municipio,
                'slug' => Str::slug($municipio),
            ]);
        }
    }
}
