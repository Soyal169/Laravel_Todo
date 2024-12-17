<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check or Create Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // Check or Create Permissions
        $createPost = Permission::firstOrCreate(['name' => 'create-post']);
        $updatePost = Permission::firstOrCreate(['name' => 'update-post']);
        $deletePost = Permission::firstOrCreate(['name' => 'delete-post']);
        $createTask = Permission::firstOrCreate(['name' => 'create-task']);
        $updateTask = Permission::firstOrCreate(['name' => 'update-task']);
        $deleteTask = Permission::firstOrCreate(['name' => 'delete-task']);

        // Assign Permissions to Roles
        $admin->permissions()->syncWithoutDetaching([
            $createPost->id, $updatePost->id, $deletePost->id,
            $createTask->id, $updateTask->id, $deleteTask->id,
        ]);

        $user->permissions()->syncWithoutDetaching([$createTask->id, $createPost->id]);

        // If you need to assign roles to users, ensure that logic is correct
        // Note: Adjust if "roles" relation logic is different
    }
}
