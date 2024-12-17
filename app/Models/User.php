<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->hasManyThrough(Permission::class,Role::class);
    }
// Check if the user has a role
    public function hasRole($role){
        return $this->roles()->contains('name',$role);
    }
// Check if the user has a permission
    public function hasPermission($permission){
        return $this->permissions()->contains('name',$permission);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>    
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
