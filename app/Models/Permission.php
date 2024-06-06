<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table='permissions';//create a table called categories
    protected $fillable=[//add attributes
        'name',
        
    ];
}
