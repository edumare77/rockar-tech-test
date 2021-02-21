<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;


class CustomerSeeder extends Seeder
{
    /**
     * Seed database using a csv file.
     *
     * @return void
     */
    public function run()
    {
        $tableName = app(Customer::class)->getTable();
        // Csv file path
        $path = 'C:/xampp/htdocs/rockar-tech-test/storage/app/private/sql_files/customer.csv';
        DB::table('customers')->truncate();

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
                    (email,forename,surname,contact_number,postcode, @created_at, @updated_at) 
                SET created_at=NOW(), updated_at=NOW()";

            $sql = sprintf($sql, $path, $tableName);
            DB::connection()->getpdo()->exec($sql);

        } catch(\PDOException $e) {

            echo $e->getMessage();
            
        }
        
    }
}
