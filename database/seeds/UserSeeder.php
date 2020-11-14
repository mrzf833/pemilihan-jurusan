<?php

use App\models\Role;
use App\models\UserProfile;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@app.com'],
            [
                'role_id' => Role::where('role','admin')->first()->id,
                'name' => 'admin',
                'password' => bcrypt('admin')
            ]
            );
        UserProfile::updateOrCreate(
            ['user_id' => $admin->id],
            [
                'fullname' => 'admin'
            ]
        );
    }
}
