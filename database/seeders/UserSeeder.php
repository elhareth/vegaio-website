<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

use App\Enums\UserStatus;
use App\Enums\UserRole;
use App\Models\SiteOption;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->breed();
    }

    /**
     *
     *
     */
    protected function breed()
    {
        // User::factory()->createMany($this->default_users());
        foreach ($this->default_users() as $option) {
            User::create($option);
        }
    }

    /**
     * Default Users
     *
     * @return array
     */
    private function default_users(): array
    {
        return [
            [
                'email'                 => 'admin@vegaio.com',
                'username'              => 'admin',
                'password'              => Hash::make('password'),
                'remember_token'        => Str::random(10),
                'user_status'           => UserStatus::ACTIVE,
                'user_role'             => UserRole::ADMIN,
                'user_info'             => [
                    'phone'                     => null,
                    'locale'                    => 'ar',
                    'avatar'                    => 'avatars/admin.jpg',
                    'last_activity'             => null,
                ],
                'activated_at'          => now()->subDecade(),
                'email_verified_at'     => now(),
                'metables' => [
                    'display_name' => [
                        'value' => 'Vega I/O',
                        'group' => 'profile',
                    ],
                    'gender' => [
                        'value' => 'bot',
                        'group' => 'profile',
                    ],
                    'bio' => [
                        'value' => 'Vega-io website administration account!',
                        'group' => 'profile',
                    ],
                ],
            ],
            [
                'email'                 => 'master@vegaio.com',
                'username'              => 'master',
                'password'              => Hash::make('password'),
                'remember_token'        => Str::random(10),
                'user_status'           => UserStatus::PENDING,
                'user_role'             => UserRole::MASTER,
                'user_info'             => [
                    'phone'                     => null,
                    'locale'                    => 'en',
                    'avatar'                    => 'avatars/master.jpg',
                    'last_login'                => null,
                    'last_activity'             => null,
                ],
                'activated_at'          => now()->subCenturies(),
                'email_verified_at'     => now(),
                'metables' => [
                    'display_name' => [
                        'value' => 'Master',
                        'group' => 'profile',
                    ],
                    'gender' => [
                        'value' => 'bot',
                        'group' => 'profile',
                    ],
                    'birthdate' => [
                        'value' => serialize(Date::make(
                            now()
                                ->subCenturies()
                                ->addYears(3)
                                ->subMonths(8)
                                ->addDays(6)
                                ->subHours(3)
                                ->addMinutes(5)
                                ->subSeconds(2)
                        )),
                        'group' => 'profile',
                    ],
                ],
            ],
            [
                'email'                 => 'omer@vegaio.com',
                'username'              => 'omer',
                'password'              => Hash::make('password'),
                'remember_token'        => Str::random(10),
                'user_status'           => UserStatus::BANNED,
                'user_role'             => UserRole::AUTHOR,
                'user_info'             => [
                    'phone'                     => null,
                    'locale'                    => 'ar',
                    'avatar'                    => 'avatars/omer.jpg',
                    'last_login'                => null,
                    'last_activity'             => null,
                ],
                'activated_at'          => now(),
                'email_verified_at'     => now(),
                'metables' => [
                    'display_name' => [
                        'value' => 'Omer',
                        'group' => 'profile',
                    ],
                    'gender' => [
                        'value' => 'male',
                        'group' => 'profile',
                    ],
                ],
            ],
            [
                'email'                 => 'elhareth@vegaio.com',
                'username'              => 'elhareth',
                'password'              => Hash::make('password'),
                'remember_token'        => Str::random(10),
                'user_status'           => UserStatus::BANNED,
                'user_role'             => UserRole::AUTHOR,
                'user_info'             => [
                    'phone'                     => null,
                    'locale'                    => 'ar',
                    'avatar'                    => 'avatars/elhareth.jpg',
                    'last_login'                => null,
                    'last_activity'             => null,
                ],
                'activated_at'          => now(),
                'email_verified_at'     => now(),
                'metables' => [
                    'display_name' => [
                        'value' => 'Elhareth Muhammed',
                        'group' => 'profile',
                    ],
                    'gender' => [
                        'value' => 'male',
                        'group' => 'profile',
                    ],
                ],
            ],
            [
                'email'                 => 'beko@vegaio.com',
                'username'              => 'beko',
                'password'              => Hash::make('password'),
                'remember_token'        => Str::random(10),
                'user_status'           => UserStatus::BLOCKED,
                'user_role'             => UserRole::EDITOR,
                'user_info'             => [
                    'phone'                     => null,
                    'locale'                    => 'ar',
                    'avatar'                    => 'avatars/bakry.jpg',
                    'last_login'                => null,
                    'last_activity'             => null,
                ],
                'activated_at'          => now()->addMonths(1),
                'email_verified_at'     => now(),
                'metables' => [
                    'display_name' => [
                        'value' => 'Bakry',
                        'group' => 'profile',
                    ],
                    'gender' => [
                        'value' => 'male',
                        'group' => 'profile',
                    ],
                ],
            ],
            [
                'email'                 => 'noor@vegaio.com',
                'username'              => 'noor',
                'password'              => Hash::make('password'),
                'remember_token'        => Str::random(10),
                'user_status'           => UserStatus::SUSPENDED,
                'user_role'             => UserRole::USER,
                'user_info'             => [
                    'phone'                     => null,
                    'locale'                    => 'ar',
                    'avatar'                    => 'avatars/noor.jpg',
                    'last_login'                => null,
                    'last_activity'             => null,
                ],
                'activated_at'          => now(),
                'email_verified_at'     => now(),
                'metables' => [
                    'display_name' => [
                        'value' => 'Mohammed Noor',
                        'group' => 'profile',
                    ],
                    'gender' => [
                        'value' => 'male',
                        'group' => 'profile',
                    ],
                ],
            ],
        ];
    }
}
