<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table='roles';//create a table called categories
    protected $fillable=[//add attributes
        'name',
        
    ];
}
