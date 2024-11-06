<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'ADERR',
                'slug' => 'aderr'
            ],
            [
                'name' => 'Embrapa',
                'slug' => 'embrapa'
            ],
            [
                'name' => 'Secretaria Municipal de Agricultura',
                'slug' => 'secretaria-municipal-de-agricultura'
            ],
            [
                'name' => 'ANVISA',
                'slug' => 'anvisa'
            ],
        ];

        collect($data)->each(function ($item) {
            Organization::firstOrCreate([
                'slug' => $item['slug'],
            ], $item);
        });
    }
}
