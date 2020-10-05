<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frog extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
}
