<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RunningProgram extends Model
{
    use HasFactory;
    protected $fillable = [
        'week',
        'description'
    ];
}
