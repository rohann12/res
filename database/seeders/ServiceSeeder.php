<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Service::create([
        'title'=>'Architecture Design',
        'description'=>"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore quaerat unde eius dolorum, nihil quae atque esse, magni dolorem suscipit quas officia! Exercitationem ipsum officia vero eaque consectetur quae nam."
       ]);
       Service::create([
        'title'=>'Earthquake Engineering',
        'description'=>"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore quaerat unde eius dolorum, nihil quae atque esse, magni dolorem suscipit quas officia! Exercitationem ipsum officia vero eaque consectetur quae nam."
       ]);
       Service::create([
        'title'=>'Foundation Engineering',
        'description'=>"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore quaerat unde eius dolorum, nihil quae atque esse, magni dolorem suscipit quas officia! Exercitationem ipsum officia vero eaque consectetur quae nam."
       ]);
       Service::create([
        'title'=>'Construction Supervision',
        'description'=>"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore quaerat unde eius dolorum, nihil quae atque esse, magni dolorem suscipit quas officia! Exercitationem ipsum officia vero eaque consectetur quae nam."
       ]);
       Service::create([
        'title'=>'Structural Design',
        'description'=>"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore quaerat unde eius dolorum, nihil quae atque esse, magni dolorem suscipit quas officia! Exercitationem ipsum officia vero eaque consectetur quae nam."
       ]);
    }
}
