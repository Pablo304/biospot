<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Em andamento',
                'slug' => 'pending',
                'color' => '#007bff',
            ],
            [
                'name' => 'Confirmada',
                'slug' => 'confirmed',
                'color' => '#28a745',
            ],
            [
                'name' => 'Descartada',
                'slug' => 'discarded',
                'color' => '#ffc107',
            ],
        ];
        collect($data)->each(function ($item) {
            Status::firstOrCreate([
                'slug' => $item['slug'],
            ], $item);
        });
    }
}
