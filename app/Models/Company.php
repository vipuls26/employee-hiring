<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable('name', 'email', 'website', 'phone', 'description', 'location', 'owner_id','created_at','updated_at')]
class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
