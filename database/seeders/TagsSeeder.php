<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $tags = 
        [
            [   'name' => 'Technology',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [   'name' => 'Health',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [   'name' => 'Business',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [   'name' => 'LifeStyle',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [   'name' => 'Entertainment',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [   'name' => 'Science',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        
        ];
        
        DB::table('tags')->insert($tags);
    }
}
