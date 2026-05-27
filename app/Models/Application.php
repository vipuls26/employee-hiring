<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('employee_name', 'employee_email', 'job_id', 'user_id', 'resume_path')]
class Application extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
