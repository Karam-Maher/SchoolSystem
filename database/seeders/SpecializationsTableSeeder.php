<?php

namespace Database\Seeders;

use App\Models\Specializations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        $specializations = [
            ['en' => 'arabic', 'ar' => 'عربي'],
            ['en' => 'sciences', 'ar' => 'علوم'],
            ['en' => 'computer', 'ar' => ' تكنولوجيا'],
            ['en' => 'english', 'ar' => 'انجليزي'],
        ];
        foreach ($specializations as $specialization) {
            Specializations::create(['name' => $specialization]);
        }
    }
}
