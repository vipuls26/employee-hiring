<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'employee_name',
        'employee_email',
        'job_id',
        'user_id',
        'overall_status',
        'resume_path',
        'reject_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(JobApplication::class, 'job_id');
    }

    public function company()
    {
        return $this->hasMany(Company::class);
    }
}
