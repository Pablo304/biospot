<?php

namespace Database\Seeders;

use App\Models\RelationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Observar',
                'slug' => 'observe',
                'is_observer' => true,
                'is_executor' => false
            ],
            [
                'name' => 'Executar',
                'slug' => 'execute',
                'is_observer' => false,
                'is_executor' => true
            ],
        ];

        collect($data)->each(function ($item) {
            RelationType::firstOrCreate([
                'slug' => $item['slug'],
            ], $item);
        });
    }
}
