<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\ComplaintOrganization;
use App\Models\ProcessInfo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            'name' => fake()->name(),
            'email' => fake()->email,
            'password' => Hash::make('123456'),
            'organization_id' => 1
        ];

        $user = User::firstOrCreate([
            'name' => $userData['name'],
        ], $userData);
        $processInfoData = [
            'description' => 'Processo de teste',
            'user_id' => $user->id,
        ];

        $processInfo = ProcessInfo::firstOrCreate($processInfoData);

        $complaint = Complaint::create([
            'started_at' => now(),
            'finished_at' => now(),
            'process_info_id' => $processInfo->id,
            'status_id' => 1, //em andamento
        ]);

        $complaintOrganizationData = [
            [
                'complaint_id' => 1,
                'organization_id' => 1, //aderr
                'relation_type' => 'observer', //observar
            ],
            [
                'complaint_id' => 1,
                'organization_id' => 2, //embrapa
                'relation_type' => 'executor', //executar
            ]
        ];

        collect($complaintOrganizationData)->each(function ($item) {
            ComplaintOrganization::firstOrCreate($item);
        });
    }
}
