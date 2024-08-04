<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'field_1',
        'field_2',
        'field_3',
        'field_4',
        'field_5',
        'field_6',
        'field_7',
        'field_8',
        'field_9',
        'field_10',
    ];
}
