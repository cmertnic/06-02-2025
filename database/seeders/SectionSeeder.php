<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::insert(
            [
                [
                    'title'=> 'Программирование',
                ],
                [
                    'title'=> 'Тестирование',
                ],
                [
                    'title'=> 'Информационная безопасность',
                ],
            ]
        );
    }
}
