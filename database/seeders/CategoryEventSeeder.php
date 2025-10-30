<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class CategoryEventSeeder extends Seeder
{
    public function run(): void
    {
        $cats = [
            ['name'=>'Tech','description'=>'Talks & hackathons'],
            ['name'=>'Music','description'=>'Concerts & festivals'],
            ['name'=>'Sports','description'=>'Tournaments & matches'],
            ['name'=>'Workshops','description'=>'Hands-on learning'],
        ];
        $map = [];
        foreach ($cats as $c) {
            $cat = Category::firstOrCreate(['name'=>$c['name']], $c);
            $map[$c['name']] = $cat->id;
        }

        $now = now();
        $events = [
            ['t'=>'React Summit','cat'=>'Tech','loc'=>'Online','d'=>3,'h1'=>10,'h2'=>16,'img'=>'https://images.unsplash.com/photo-1518779578993-ec3579fee39f?w=1200&q=80'],
            ['t'=>'Indie Night','cat'=>'Music','loc'=>'City Hall','d'=>5,'h1'=>19,'h2'=>22,'img'=>'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=1200&q=80'],
            ['t'=>'Marathon 10K','cat'=>'Sports','loc'=>'Riverside Park','d'=>8,'h1'=>7,'h2'=>12,'img'=>'https://images.unsplash.com/photo-1542281286-9e0a16bb7366?w=1200&q=80'],
            ['t'=>'Docker Workshop','cat'=>'Workshops','loc'=>'Tech Hub','d'=>12,'h1'=>14,'h2'=>17,'img'=>'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=1200&q=80'],
            ['t'=>'Cloud Conf','cat'=>'Tech','loc'=>'Convention Center','d'=>2,'h1'=>9,'h2'=>17,'img'=>'https://images.unsplash.com/photo-1518779578993-ec3579fee39f?w=1200&q=80'],
            ['t'=>'AI Expo','cat'=>'Tech','loc'=>'Expo Grounds','d'=>9,'h1'=>10,'h2'=>18,'img'=>'https://images.unsplash.com/photo-1508754945980-9a55f0d3d601?w=1200&q=80'],
            ['t'=>'Jazz Fest','cat'=>'Music','loc'=>'Riverside Stage','d'=>1,'h1'=>18,'h2'=>23,'img'=>'https://images.unsplash.com/photo-1506157786151-b8491531f063?w=1200&q=80'],
            ['t'=>'Rock Arena','cat'=>'Music','loc'=>'Arena X','d'=>20,'h1'=>19,'h2'=>23,'img'=>'https://images.unsplash.com/photo-1483412033650-1015ddeb83d1?w=1200&q=80'],
            ['t'=>'Half Marathon','cat'=>'Sports','loc'=>'City Center','d'=>18,'h1'=>6,'h2'=>11,'img'=>'https://images.unsplash.com/photo-1508609349937-5ec4ae374ebf?w=1200&q=80'],
            ['t'=>'Football Finals','cat'=>'Sports','loc'=>'Stadium A','d'=>15,'h1'=>17,'h2'=>20,'img'=>'https://images.unsplash.com/photo-1518609878373-06d740f60d8b?w=1200&q=80'],
            ['t'=>'Photography Workshop','cat'=>'Workshops','loc'=>'Art Lab','d'=>6,'h1'=>13,'h2'=>16,'img'=>'https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?w=1200&q=80'],
            ['t'=>'UX Bootcamp','cat'=>'Workshops','loc'=>'Design Center','d'=>13,'h1'=>9,'h2'=>17,'img'=>'https://images.unsplash.com/photo-1553877522-43269d4ea984?w=1200&q=80'],
            ['t'=>'Startup Pitch Night','cat'=>'Tech','loc'=>'Innovation Hub','d'=>11,'h1'=>18,'h2'=>21,'img'=>'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=1200&q=80'],
            ['t'=>'Classical Evening','cat'=>'Music','loc'=>'Opera House','d'=>17,'h1'=>19,'h2'=>22,'img'=>'https://images.unsplash.com/photo-1516570161787-2fd917215a3d?w=1200&q=80'],
        ];

        foreach ($events as $e) {
            Event::create([
                'title' => $e['t'],
                'description' => null,
                'category_id' => $map[$e['cat']],
                'location' => $e['loc'],
                'start_at' => $now->copy()->addDays($e['d'])->setHour($e['h1'])->setMinute(0),
                'end_at' => $now->copy()->addDays($e['d'])->setHour($e['h2'])->setMinute(0),
                'banner_path' => $e['img'],
                'created_by' => null,
            ]);
        }
    }
}
