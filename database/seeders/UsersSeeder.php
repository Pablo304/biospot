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
                'organization_id' => 1,
                'role_slug' => 'fiscal'
            ],
            [
                'name' => 'Embrapa',
                'email' => 'embrapa@teste.com',
                'password' => '123456',
                'organization_id' => 2,
                'role_slug' => 'specialist'
            ],
            [
                'name' => 'denym',
                'email' => 'deny@teste.com',
                'password' => '123456',
                'organization_id' => null,
                'role_slug' => 'citizen'
            ],
        ];

        collect($data)->each(function ($item) {
            User::firstOrCreate([
                'name' => $item['name'],
            ], $item);
        });
    }
}
