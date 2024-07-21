<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name',
        'job_title',
        'job_location',
        'job_type',
        'app_platform',
        'job_status',
        'job_desc',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
