<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;

class ReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $reports = factory(\App\Report::class, 100)->create();

        Eloquent::reguard();
    }

}
