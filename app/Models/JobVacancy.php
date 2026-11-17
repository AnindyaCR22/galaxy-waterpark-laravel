<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

    protected $table = 'job_vacancies';

    protected $fillable = [
        'title',
        'company',
        'location',
        'salary',
        'jenis_pekerjaan',
        'description',
        'logo',
    ];
}