<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('name', 'email', 'website', 'phone', 'description', 'location', 'owner_id')]
class Company extends Model
{

    protected $table = 'company';

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
