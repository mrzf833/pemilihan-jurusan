<?php

use App\models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(
            ['role' => 'admin']
        );

        Role::updateOrCreate(
            ['role' => 'admin']
        );
    }
}
