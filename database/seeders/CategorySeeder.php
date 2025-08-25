<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'LED Recessed Luminaire',
                'details' => 'High-quality LED recessed lighting solutions for modern interiors',
                'type' => 'indoor',
                'order' => 1,
                'thumbnail' => 'MAIN/01. LED RECESSED/FS-RNDO-002WBMW-W7.jpg',
            ],
            [
                'name' => 'LED Modular Recessed Luminaire',
                'details' => 'Versatile modular LED lighting systems for customizable installations',
                'type' => 'indoor',
                'order' => 2,
                'thumbnail' => 'MAIN/02. LED MODULAR/MIR-Z421A2002_W.jpg',
            ],
            [
                'name' => 'LED Surface Mounted Luminaire',
                'details' => 'Surface mounted LED solutions for easy installation and maximum impact',
                'type' => 'indoor',
                'order' => 3,
                'thumbnail' => 'MAIN/03. LED SURFACE MOUNTED/MIR-D401A1030_B12.jpg',
            ],
            [
                'name' => 'High Voltage Track Luminaire',
                'details' => 'Professional track lighting systems for flexible illumination needs',
                'type' => 'indoor',
                'order' => 4,
                'thumbnail' => 'MAIN/04. HIGH VOLTAGE TRACK/白.jpg',
            ],
            [
                'name' => 'LED Mini Magnetic Track Luminaire',
                'details' => 'Innovative magnetic track lighting for modern applications',
                'type' => 'indoor',
                'order' => 5,
                'thumbnail' => 'MAIN/06. MINI MAGNETIC TRACK/10mm-catalogue-gigapixel-standard-scale-4_00x_09.jpg',
            ],
            [
                'name' => 'LED Wire Track Luminaire (Hueline Series)',
                'details' => 'Elegant wire track lighting solutions for contemporary spaces',
                'type' => 'indoor',
                'order' => 6,
                'thumbnail' => 'MAIN/07. WIRE TRACK (HUELINE)/Indoor-New Catalogue for Color Bridge Series_Page_5-gigapixel-standard-scale-2_05x - Copy - Copy.jpg',
            ],
            [
                'name' => 'LED Commercial Luminaire',
                'details' => 'Commercial-grade LED lighting for professional environments',
                'type' => 'indoor',
                'order' => 7,
                'thumbnail' => 'MAIN/09. LED COMMERCIAL/MIR-P404A1001_2.jpg',
            ],
            [
                'name' => 'LED Profile Luminaire',
                'details' => 'Sleek profile LED lighting for architectural applications',
                'type' => 'indoor',
                'order' => 8,
                'thumbnail' => 'MAIN/10. PROFILE/fos-led-hanging-profile-light-48w-tube-light-4-feet.jpg',
            ],
            [
                'name' => 'LED Strip Luminaire',
                'details' => 'Flexible LED strip lighting for versatile illumination solutions',
                'type' => 'indoor',
                'order' => 9,
                'thumbnail' => 'MAIN/11. STRIP/CUB_05.jpg',
            ],
            [
                'name' => 'Drivers & Accessories',
                'details' => 'Essential components and accessories for LED lighting systems',
                'type' => 'indoor',
                'order' => 10,
                'thumbnail' => 'MAIN/12. DRIVERS & ACCESORIES/Asset 4@4x.jpg',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 