<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'nik', 'gender', 'date_birth', 'address', 'province', 'regency'];
}
