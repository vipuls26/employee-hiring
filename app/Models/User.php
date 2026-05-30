<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'owner_id');
    }

    public function companyHr()
    {
        return $this->hasOne(Company::class, 'hr_id');
    }

    public function companyManager()
    {
        return $this->hasOne(Company::class, 'manager_id');
    }

    public function jobApplication()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function jobApply()
    {
        return $this->hasMany(Application::class);
    }
}
