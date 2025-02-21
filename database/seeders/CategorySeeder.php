<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            [
                'name' => 'Ebook',
                'slug' => 'ebook',
                'icon' => 'images/icons/ebook.svg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Course',
                'slug' => 'course',
                'icon' => 'images/icons/course.svg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Template',
                'slug' => 'template',
                'icon' => 'images/icons/template.svg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Font',
                'slug' => 'font',
                'icon' => 'images/icons/font.svg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
             ],
        ]);
    }
}
