<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $seeders = [ContactsSeeder::class];
    protected $tables = ['contacts'];

    public function run()
    {
    	$this->cleanTables();
        foreach ($this->seeders as $seeder) {
        	$this->call($seeder);
        }
    }

     private function cleanTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    	foreach ($this->tables as $table) {
    		DB::table($table)->truncate();
    	}
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
