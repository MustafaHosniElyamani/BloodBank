<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    // public function authorizedRoutes()
    // {
    //     $authorizedRoutes = [];
    //     $permissions = $this->getAllPermissions();
    //     foreach ($permissions as $permission) {
    //         $routeName = $permission->routes;
    //         if ($routeName && Route::has($routeName)) {
    //             $route = Route::getRoutes()->getByName($routeName);
    //             $routeLabel = $route->getName() ?? $route->uri();
    //             $authorizedRoutes[$routeName] = $routeLabel;
    //         }
    //     }
    //     return $authorizedRoutes;
    // }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
