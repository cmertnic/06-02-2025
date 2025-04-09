<?php

namespace Database\Seeders;

use App\Models\Statue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Statue::insert(
            [
                [
                    'name'=> '',
                ],
                [
                    'name'=> '',
                ],
            ]
        );
    }
}
