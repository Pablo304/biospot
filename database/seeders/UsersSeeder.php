<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Aderr',
                'email' => 'aderr@teste.com',
                'password' => '123456',
                'organization_id' => 1
            ],
            [
                'name' => 'Embrapa',
                'email' => 'embrapa@teste.com',
                'password' => '123456',
                'organization_id' => 2
            ],
            [
                'name' => 'denym',
                'email' => 'deny@teste.com',
                'password' => '123456',
                'organization_id' => null
            ],
        ];

        collect($data)->each(function ($item) {
            User::firstOrCreate([
                'name' => $item['name'],
            ], $item);
        });
    }
}
