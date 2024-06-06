<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table='categories';//create a table called categories
    protected $fillable=[//add attributes
        'name',
        'description',
        'is_active',
    ];
}
