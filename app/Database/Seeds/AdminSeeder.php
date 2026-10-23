<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class AdminSeeder extends Seeder
{
    public function run()
    {


        for ($i = 0; $i < 4; $i++) {
            if($i === 0){
                // Create the specified admin user
                $userData = [
                    'username'=> 'adriangarber',
                    'email'=> 'adriangarber@localhost.com',
                    'password'=> '5832552911',
                    'active'=> true,
                ];
            } elseif ($i === 1) {
                $userData = [
                    'username' => 'webtechguy',
                    'email'    => 'demouser@localhost.com',
                    'password' => '5832552911',
                    'active'   => true,
                ];
            } elseif ($i === 2) {
                $userData = [
                    'username'=> 'guestuser',
                    'email'=> 'guestuser@example.com',
                    'password'=> 'Password123!',
                    'active'=> true,
                ];
            } else {
                // Create additional admin users with fake data
                $userData = [
                    'username' => 'P3n3lop3P0tts',
                    'email'    => 'potts@localhost.com',
                    'password' => '5832552911', // Default password for fake admins
                    'active'   => true,
                ];
            }

            // Retrieve the user back from DB to ensure ID is set
            $savedUser = $this->createUser($userData);

            if (!$savedUser) {
                echo "Failed to retrieve newly created user.\n";
                return;
            }

            // Assign groups
            if($i === 0){
                $savedUser->addGroup('admin');
                $savedUser->addGroup('user');
            } else {
                $savedUser->addGroup('user');
            }
            // (Optional) Activate the user (usually redundant if 'active' is set)
            //$savedUser->activate();

            echo "User created successfully.\n";

        }
    }

    protected function createUser(array $data)
    {
        $users = new UserModel();

        $user = new User($data);

        if (!$users->save($user)) {
            echo "Failed to create user: " . $data['username'] . "\n";
            print_r($users->errors());
            return null;
        }

        return $users->find($users->getInsertID());
    }
}
