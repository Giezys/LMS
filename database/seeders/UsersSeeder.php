<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_profiles')->truncate();

        DB::table('tbl_profiles')->insert([
            [
                'nama' => 'admin',
                'email' => 'admin@gmail.com',
                'no_tlp' => '081310592331',
                'password' => Hash::make('12345'),
            ],

        ]);
    }
}