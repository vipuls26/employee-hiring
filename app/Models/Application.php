<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['employee_name', 'employee_email', 'job_id', 'user_id', 'overall_status'])]
class Application extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(JobApplication::class, 'job_id');
    }

    public function approvals()
    {
        return $this->hasMany(ApplicationApproval::class);
    }
}
