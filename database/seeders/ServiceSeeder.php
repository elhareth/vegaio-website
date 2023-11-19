<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Category;

use Plank\Mediable\Facades\MediaUploader;

use Illuminate\Support\Facades\File;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Mews\Purifier\Facades\Purifier;

class ServiceSeeder extends Seeder
{
    /**
     * Services
     */
    protected static $services = [
        'ux-ui' => [
            'name' => "UX/UI",
            'label' => "تصميم UX/UI",
            'slider' => [
                'static/services/portfolio/ui-ux-p-001.jpg',
                'static/services/portfolio/ui-ux-p-002.jpg',
                'static/services/portfolio/ui-ux-p-003.jpg',
                'static/services/portfolio/ui-ux-p-004.jpg',
                'static/services/portfolio/ui-ux-p-005.jpg',
            ],
        ],
        'wdd' => [
            'name' => "Web Designing & Development",
            'label' => "تصميم و تطوير مواقع الويب",
            'slider' => [
                'static/services/portfolio/wdd-p-001.jpg',
                'static/services/portfolio/wdd-p-002.jpg',
                'static/services/portfolio/wdd-p-003.jpg',
            ],
        ],
        'mobile-apps' => [
            'name' => "Mobile Applications",
            'label' => "تطبيقات الجوال",
            'slider' => [
                'static/services/portfolio/mobile-apps-p-001.jpg',
                'static/services/portfolio/mobile-apps-p-002.jpg',
                'static/services/portfolio/mobile-apps-p-003.jpg',
                'static/services/portfolio/mobile-apps-p-004.jpg',
                'static/services/portfolio/mobile-apps-p-005.jpg',
            ],
        ],
        'graphic-design' => [
            'name' => "Graphic Desgin",
            'label' => "التصميم الجرافيكي",
            'slider' => [
                'static/services/portfolio/graphic-design-p-001.jpg',
                'static/services/portfolio/graphic-design-p-002.jpg',
                'static/services/portfolio/graphic-design-p-003.jpg',
                'static/services/portfolio/graphic-design-p-004.jpg',
            ],
        ],
        'vi' => [
            'name' => "Visiual Identifications",
            'label' => "الهويات البصرية",
            'slider' => [
                'static/services/portfolio/vi-p-001.jpg',
                'static/services/portfolio/vi-p-002.jpg',
                'static/services/portfolio/vi-p-003.jpg',
            ],
        ],
        'montage' => [
            'name' => "Montage",
            'label' => "المونتاج",
            'description' => "",
            'slider' => [
                'static/services/portfolio/montage-p-001.jpg',
                'static/services/portfolio/montage-p-002.jpg',
                'static/services/portfolio/montage-p-003.jpg',
            ],
        ],
        'content-writing' => [
            'name' => "Content Writing",
            'label' => "كتابة المحتوى",
            'slider' => [
                'static/services/portfolio/content-writing-p-001.jpg',
                'static/services/portfolio/content-writing-p-002.jpg',
                'static/services/portfolio/content-writing-p-003.jpg',
                'static/services/portfolio/content-writing-p-004.jpg',
            ],
        ],
        'social-platforms-management' => [
            'name' => "Social Platforms Management",
            'label' => "إدارة المنصات الإجتماعية",
            'slider' => [
                'static/services/portfolio/social-platforms-p-001.jpg',
                'static/services/portfolio/social-platforms-p-002.jpg',
                'static/services/portfolio/social-platforms-p-003.jpg',
                'static/services/portfolio/social-platforms-p-004.jpg',
            ],
        ],
        'e-marketing' => [
            'name' => "E-Marketing",
            'label' => "التسويق الإلكتروني",
            'slider' => [
                'static/services/portfolio/e-marketing-p-001.jpg',
                'static/services/portfolio/e-marketing-p-002.jpg',
                'static/services/portfolio/e-marketing-p-003.jpg',
                'static/services/portfolio/e-marketing-p-004.jpg',
            ],
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Service::factory()->createMany([
        //     //
        // ]);

        // Service::factory(10)->for(Category::where('slug', 'services')->first())->create();

        $category = Category::firstWhere('slug', 'services');

        if (!$category) {
            return;
        }

        foreach (static::$services as $key => $service) {
            $Service = new Service([
                'slug' => $key,
                'name' => $service['name'],
                'label' => $service['label'],
            ]);

            $Service->description = Purifier::clean(file_get_contents(__DIR__ . "/html/{$key}.html"));

            $Service->category()->associate($category);
            $Service->save();

            if ($Service) {
                $media = MediaUploader::fromSource(storage_path("app/static/services/{$key}.jpg"))
                    ->toDisk('media')
                    ->toDirectory('services')
                    ->upload();
                $Service->attachMedia($media, 'thumbnail');

                if (isset($service['slider']) && is_array($service['slider'])) {
                    $slider = [];

                    foreach ($service['slider'] as $path) {
                        $slider = MediaUploader::fromSource(storage_path('app/' . $path))
                            ->toDisk('media')
                            ->toDirectory('services')
                            ->useHashForFilename()
                            ->upload();
                        $Service->attachMedia($slider, 'slider');
                    }
                }
            }
        }
    }
}
