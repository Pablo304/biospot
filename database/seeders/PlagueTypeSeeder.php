<?php

namespace Database\Seeders;

use App\Models\Plague\PlagueType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlagueTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Sigatoka-negra',
                'description' => 'Sigatoka-negra',
                'is_public' => true
            ],
            [
                'name' => 'Sigatoka-vermelha',
                'description' => 'Sigatoka-vermelha',
                'is_public' => false
            ],
            [
                'name' => 'Sigatoka-amarela',
                'description' => 'Sigatoka-amarela',
                'is_public' => true
            ],
            [
                'name' => 'Sigatoka-azul',
                'description' => 'Sigatoka-azul',
                'is_public' => false
            ],
        ];

        collect($data)->each(function ($item) {
            PlagueType::firstOrCreate([
                'name' => $item['name'],
            ], $item);
        });
    }
}
