<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            'firstname' => 'Jason',
            'lastname' => 'Sweeney',
            'email' => 'jason@wurkhouse.com'
        ]);
    }
}
