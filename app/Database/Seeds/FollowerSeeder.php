<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class FollowerSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $appConfig = config('App');// Get App config file values

        $followersList = [
            [
                'follower_id' => 1,
                'followed_id' => 2,
                'status' => 'accepted',
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ],
            [
                'follower_id' => 1,
                'followed_id' => 3,
                'status' => 'accepted',
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ],
            [
                'follower_id' => 1,
                'followed_id' => 4,
                'status' => 'accepted',
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ],
            [
                'follower_id' => 2,
                'followed_id' => 1,
                'status' => 'accepted',
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ],
            [
                'follower_id' => 2,
                'followed_id' => 3,
                'status' => 'accepted',
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ],
            [
                'follower_id' => 2,
                'followed_id' => 4,
                'status' => 'accepted',
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ],
            [
                'follower_id' => 3,
                'followed_id' => 1,
                'status' => 'accepted',
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ],
            [
                'follower_id' => 3,
                'followed_id' => 2,
                'status' => 'accepted',
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ],
            [
                'follower_id' => 3,
                'followed_id' => 4,
                'status' => 'accepted',
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('followers')->insertBatch($followersList);
    }
}
