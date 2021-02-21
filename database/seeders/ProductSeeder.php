<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Csv file path
        $tableName = app(Product::class)->getTable();
        $path = 'C:/xampp/htdocs/rockar-tech-test/storage/app/private/sql_files/product.csv';
        DB::table('products')->truncate();

        try{
            //  Populate table using csv file
            $sql = "LOAD DATA INFILE '%s' 
                    IGNORE INTO TABLE %s 
                    CHARACTER SET utf8 FIELDS 
                    TERMINATED BY ',' 
                    ENCLOSED BY '\"' 
                    ESCAPED BY '' 
                    LINES TERMINATED BY '\n' 
                    IGNORE 1 LINES 
                    (vin,colour,make,model,price, @created_at, @updated_at) 
                SET created_at=NOW(), updated_at=NOW()";

            $sql = sprintf($sql, $path, $tableName);
            DB::connection()->getpdo()->exec($sql);
        } 
        
        catch(\PDOException $e) {

            echo $e->getMessage();
            
        }
        
    }
}
