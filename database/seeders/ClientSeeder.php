<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('clients')->insert([
            ['logo_path'=>"anot.png",'company_name'=>"A. Not Architecture N. Architects Pvt. Ltd."],
            ['logo_path'=>"catholic.png",'company_name'=>"Catholic Relief Services"],
            ['logo_path'=>"ceServices.png",'company_name'=>"CE Services Pvt. Ltd.",],
            ['logo_path'=>"cgProperties.png",'company_name'=>"CG Properties",],
            ['logo_path'=>"childFund.png",'company_name'=>"Child Fund Alliance",],
            ['logo_path'=>"dwarikas.png",'company_name'=>"Dwarika's Hotel",],
            ['logo_path'=>"dzi.png",'company_name'=>"dZi Foundation",],
            ['logo_path'=>"greenHill.png",'company_name'=>"GreenHill City Pvt. Ltd.",],
            ['logo_path'=>"gsi.png",'company_name'=>"Geotech Solution International",],
            ['logo_path'=>"hyatt.png",'company_name'=>"Hyatt Regency",],
            ['logo_path'=>"Ka_Nying_Shedrub_Ling.png",'company_name'=>"Ka-Nying Shedrub Ling Monastery",],
            ['logo_path'=>"kll.png",'company_name'=>"Kathmandu Living Labs",],
            ['logo_path'=>"ncell.png",'company_name'=>"Ncell ",],
            ['logo_path'=>"nepalBank.png",'company_name'=>"Nepal Bank Limited",],
            ['logo_path'=>"nepalPragya.png",'company_name'=>"Nepal Pragya Pratisthan",],
            ['logo_path'=>"practicalAction.png",'company_name'=>"Practical Action Nepal",],
            ['logo_path'=>"vespa.png",'company_name'=>"Vespa Nepal",],
            ['logo_path'=>"yakNyeti.png",'company_name'=>"Hotel Yak & Yeti",],
        ]);
    }
}
