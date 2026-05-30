<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable('name', 'email', 'website', 'phone', 'description', 'location', 'owner_id', 'created_at', 'updated_at', 'hr_id', 'manager_id')]
class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function hr()
    {
        return $this->belongsTo(User::class, 'hr_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
