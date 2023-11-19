<?php

namespace Database\Seeders;

use App\Models\SiteOption;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteOptionSeeder extends Seeder
{
    /**
     * Default Site Options
     *
     * @var array
     */
    protected static $default_options = [
        'site_status' => [
            'label' => 'Site Status',
            'value' => 'development',
            'group' => 'site_meta',
            'autoload' => true,
        ],

        'site_icon' => [
            'label' => 'Site Icon',
            'value' => '',
            'group' => 'site_meta',
            'autoload' => true,
        ],

        'site_logo' => [
            'label' => 'Site Logo',
            'value' => '',
            'group' => 'site_meta',
            'autoload' => true,
        ],

        'site_language' => [
            'label' => 'Site Language',
            'value' => 'ar',
            'group' => 'site_meta',
            'autoload' => true,
        ],

        'site_name' => [
            'label' => 'Site Name',
            'value' => 'VegaIO',
            'group' => 'site_meta',
            'autoload' => true,
        ],

        'site_label' => [
            'label' => 'Site Label',
            'value' => 'Vega-IO',
            'group' => 'site_meta',
            'autoload' => true,
        ],

        'site_title' => [
            'label' => 'Site Title',
            'value' => 'Vega I/O',
            'group' => 'site_meta',
            'autoload' => true,
        ],

        'site_tagline' => [
            'label' => 'Site Tagline',
            'value' => 'Bettter digital experience with Vega I/O',
            'group' => 'site_meta',
            'autoload' => true,
        ],

        'site_keywords' => [
            'label' => 'Site Keywords',
            'value' => [
                'Web design',
                'Web development',
                'Programmin',
                'Graphic design',
                'Marketing',
                'CRM',
                'Blog',
                'Vega',
                'IO',
                'Technology',
            ],
            'group' => 'site_meta',
            'autoload' => true,
        ],

        'site_description' => [
            'label' => 'Site Description',
            'value' => 'Vega IO technology!',
            'group' => 'site_meta',
            'autoload' => true,
        ],

        'contact_info' => [
            'label' => 'Contact Info',
            'value' => [
                'emails' => [
                    'primary' => 'info@vegaio.com',
                    'contact' => 'contact@vegaio.com',
                    'adsense' => 'ads@vegaio.com',
                ],
                'phones' => [
                    'primary' => '+249 12 345 6789',
                    'contact' => '+249 12 345 6789',
                    'adsense' => '+249 12 345 6789',
                ],
                'social' => [
                    'github' => null,
                    'youtube' => null,
                    'twitter' => null,
                    'linkedin' => null,
                    'facebook' => null,
                    'whatsapp' => null,
                    'instagram' => null,
                ],
                'address' => 'Sudan, Algezira, Almanaqil',
                'locations' => [
                    'khartoum-1' => [
                        'country' => 'Sudan',
                        'state' => 'Khartoum',
                        'city' => 'Khartoum',
                        'street' => 'Alamarat St 15',
                        'place' => null,
                        'location' => null,
                        'lng' => null,
                        'lat' => null,
                    ],
                ],
            ],
            'group' => null,
            'autoload' => true,
        ],

        'reserved_usernames' => [
            'label' => 'Reserved Usernames',
            'value' => [],
            'group' => 'auth',
            'autoload' => false,
        ],

        'user_login' => [
            'label' => 'Login Stricts',
            'value' => [],
            'group' => 'auth',
            'autoload' => false,
        ],

        'user_registration' => [
            'label' => 'Registration',
            'value' => [],
            'group' => 'auth',
            'autoload' => false,
        ],

        'rss_feeds' => [
            'label' => 'RSS Feeds',
            'value' => [],
            'group' => null,
            'autoload' => false,
        ],

        'blog_settings' => [
            'label' => 'Blog Settings',
            'value' => [],
            'group' => null,
            'autoload' => true,
        ],

        'template_settings' => [
            'label' => 'Template Settings',
            'value' => [
                //
            ],
            'group' => null,
            'autoload' => true,
        ],

        'subscriptions' => [
            'label' => 'Subscriptions',
            'value' => [],
            'group' => null,
            'autoload' => false,
        ],

        'index_hero_section' => [
            'label' => 'Hero Section',
            'value' => [
                'label' => 'Hero Section',
                'tagline' => 'Hero Section Tagline',
                'description' => 'Hero Section Description',
            ],
            'group' => 'index_sections',
            'autoload' => false,
        ],

        'index_about_section' => [
            'label' => 'About Section',
            'value' => [
                'label' => 'About Section',
                'tagline' => 'About Section Tagline',
                'description' => 'About Section Description',
                'tiles' => [
                    'one' => [
                        'icon' => 'bx bx-receipt',
                        'label' => 'Receipt',
                        'title' => 'First Tile Title',
                        'description' => 'Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip',
                    ],
                    'two' => [
                        'icon' => 'bx bx-cube-alt',
                        'label' => 'Cube',
                        'title' => 'Second Tile Title',
                        'description' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt',
                    ],
                    'three' => [
                        'icon' => 'bx bx-images',
                        'label' => 'Images',
                        'title' => 'Third Tile Title',
                        'description' => 'Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere',
                    ],
                    'four' => [
                        'icon' => 'bx bx-shield',
                        'label' => 'Shield',
                        'title' => 'Forth Tile Title',
                        'description' => 'Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta',
                    ],
                ],
                'action' => [
                    'label' => 'More about Vega I/O',
                    'route' => null,
                ],
            ],
            'group' => 'index_sections',
            'autoload' => false,
        ],

        'index_services_section' => [
            'label' => 'Services Section',
            'value' => [
                'label' => 'Services',
                'tagline' => 'Our Services',
                'description' => 'Our Services Description',
            ],
            'group' => 'index_sections',
            'autoload' => false,
        ],

        'index_contact_section' => [
            'label' => 'Contact us Section',
            'value' => [
                'label' => 'Contact',
                'tagline' => 'Contact Us',
                'description' => 'Contact us Description',
            ],
            'group' => 'index_sections',
            'autoload' => false,
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_options = [];

        foreach (static::$default_options as $key => $data) {
            $data['name'] = $key;
            $default_options[] = $data;
        }

        // SiteOption::factory()->createMany($default_options);
        // SiteOption::upsert($default_options, ['name']);
        foreach ($default_options as $option) {
            SiteOption::create($option);
        }
    }
}
