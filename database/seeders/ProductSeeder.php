<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'C:/xampp/htdocs/rockar-tech-test/storage/app/private/sql_files/product.csv';
        DB::table('products')->delete();
        $sql = file_get_contents('./database/seeds/products.sql');
        $sql = sprintf($sql, $path);
        DB::connection()->getpdo()->exec($sql);
    }
}
