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
                'color' => '#ff0000',
            ],
            [
                'name' => 'Resolvido',
                'slug' => 'resolved',
                'color' => '#00ff00',
            ],
        ];


        collect($data)->each(function ($item) {
            PlagueStatus::firstOrCreate([
                'name' => $item['name'],
            ], $item);
        });
    }
}
