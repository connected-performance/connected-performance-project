<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Service::create(['title'=>'1 on 1 Training']);
        Service::create(['title'=>'Consultation']);
        Service::create(['title'=>'Connect Player Development Software']);

    }
}
