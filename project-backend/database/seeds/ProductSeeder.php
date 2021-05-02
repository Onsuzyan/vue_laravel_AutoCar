<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['model' => Str::random(10),'make'=>Str::random(10) ,'year'=> mt_rand(1970, 2020), 'part_number'=> Str::random(8), 'name'=>Str::random(6)],
            ['model' => Str::random(10),'make'=>Str::random(10) ,'year'=> mt_rand(1970, 2020), 'part_number'=> Str::random(8), 'name'=>Str::random(6)],
            ['model' => Str::random(10),'make'=>Str::random(10) ,'year'=> mt_rand(1970, 2020), 'part_number'=> Str::random(8), 'name'=>Str::random(6)],
            ['model' => Str::random(10),'make'=>Str::random(10) ,'year'=> mt_rand(1970, 2020), 'part_number'=> Str::random(8), 'name'=>Str::random(6)],
            ['model' => Str::random(10),'make'=>Str::random(10) ,'year'=> mt_rand(1970, 2020), 'part_number'=> Str::random(8), 'name'=>Str::random(6)],
            ['model' => Str::random(10),'make'=>Str::random(10) ,'year'=> mt_rand(1970, 2020), 'part_number'=> Str::random(8), 'name'=>Str::random(6)],
            ['model' => Str::random(10),'make'=>Str::random(10) ,'year'=> mt_rand(1970, 2020), 'part_number'=> Str::random(8), 'name'=>Str::random(6)],

        ]);
    }
}
