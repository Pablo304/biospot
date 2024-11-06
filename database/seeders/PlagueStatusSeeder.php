<?php

namespace Database\Seeders;

use App\Models\Plague\PlagueStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlagueStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Ativo',
                'slug' => 'active',
                'color' => '#00ff00',
            ],
            [
                'name' => 'Resolvido',
                'slug' => 'resolved',
                'color' => '#ff0000',
            ],
        ];


        collect($data)->each(function ($item) {
            PlagueStatus::firstOrCreate([
                'name' => $item['name'],
            ], $item);
        });
    }
}
