<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 // database/migrations/xxxx_xx_xx_create_roles_and_permissions_tables.php
public function up()
{
    Schema::create('roles', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->timestamps();
    });

    Schema::create('permissions', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->timestamps();
    });

    Schema::create('role_user', function (Blueprint $table) {
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('role_id')->constrained()->onDelete('cascade');
        $table->primary(['user_id', 'role_id']);
    });

    Schema::create('permission_role', function (Blueprint $table) {
        $table->foreignId('role_id')->constrained()->onDelete('cascade');
        $table->foreignId('permission_id')->constrained()->onDelete('cascade');
        $table->primary(['role_id', 'permission_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
