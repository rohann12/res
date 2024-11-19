<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'id' => 1,
            'name' => 'Resilient ',
            'logo' => 'logo.png',
            'slogan' => 'logo.png',
            'welcome_text' => 'Hi! Our Company has been present for over 20 years in the market. We make the most of all our customers.',
            'description' => 'Resilient Structures Private Limited is an engineering consulting firm primarily focused on Building design, Structural engineering, and earthquake engineering. The firm was founded in February 2016. Aftermath of the recent 2015 Gorkha earthquake, it was felt that there is severe lack of good structural engineering consultants in the country who could carry out good structural design of buildings and structures that can withstand natural forces such as earthquakes, wind, fire and so on. This realization led to the establishment of an engineering consulting firm specializing in Building design, Structural engineering, and earthquake engineering.',
            'email' => 'resilientstructures@gmail.com',
            'contact' => '9841334036 , 9851084063',
            'address' => 'Fourth Floor, Bluestar Complex, Thapathali, Kathmandu, Nepal',
            'fbLink' => 'https://m.facebook.com/people/Resilient-Structures-Private-Limited/100057362443026/',
            'instaLink' => 'https://www.instagram.com',
            'linkedInLink' => 'https://www.linkedin.com/company/resilience-structures-gh/',
        ]);
    }
}
