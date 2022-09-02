<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeedUpgrade extends Model
{
    use HasFactory;
    protected $fillable = [
        'current_version',
        'feature_version',
        'need_upgrade',
    ];
}
