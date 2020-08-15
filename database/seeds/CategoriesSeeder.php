<?php

use Illuminate\Database\Seeder;
use App\Entities\Categories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        Categories::create(['name' => 'Doces']);
        Categories::create(['name' => 'Salgados']);
        Categories::create(['name' => 'Bebidas']);
        Categories::create(['name' => 'Rápidos']);
        Categories::create(['name' => 'Almoço']);
        Categories::create(['name' => 'Jantar']);
        Categories::create(['name' => 'Risotos']);

    }
}
