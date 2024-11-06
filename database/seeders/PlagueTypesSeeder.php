<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlagueTypesSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
    {
        DB::table('plague_types')->insert([
            [
                'name' => 'Mosca da Carambola',
                'name_cientific' => 'Bactrocera carambolae',
                'description' => 'A mosca da carambola é uma praga que afeta diversas frutas, especialmente a carambola, causando perdas significativas na produção.',
            ],
            [
                'name' => 'Cancro Cítrico',
                'name_cientific' => 'Xanthomonas citri',
                'description' => 'O cancro cítrico é uma doença bacteriana que afeta plantas cítricas, causando lesões nas folhas, frutos e galhos.',
            ],
            [
                'name' => 'Bicudo da Acerola',
                'name_cientific' => 'Anthonomus tomentosus',
                'description' => 'O bicudo da acerola é um inseto que ataca flores e frutos de acerola, causando perdas na produção.',
            ],
            [
                'name' => 'Ácaro Hindus Tânico dos Citros',
                'name_cientific' => 'Schizotetranychus hindustanicus',
                'description' => 'Este ácaro é uma praga que infesta citros, provocando danos às folhas e à qualidade dos frutos.',
            ],
            [
                'name' => 'Moníliase',
                'name_cientific' => 'Moniliophthora roreri',
                'description' => 'A moníliase é uma doença fúngica que afeta frutas tropicais, como o cacau, causando murchamento e apodrecimento.',
            ],
            [
                'name' => 'Moko da Bananeira',
                'name_cientific' => 'Ralstonia solanacearum',
                'description' => 'O moko da bananeira é uma doença bacteriana que ataca o sistema vascular das bananeiras, levando à morte das plantas.',
            ],
            [
                'name' => 'Fusariose da Bananeira',

                'name_cientific' => 'Fusarium oxysporum f. sp. cubense',
                'description' => 'A fusariose é uma doença causada por fungo que afeta o sistema radicular da bananeira, resultando no amarelamento e murcha das folhas.',
            ],
        ]);
    }
}
