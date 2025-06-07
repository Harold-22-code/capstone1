<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BurialRecord extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'date_of_death',
        'date_of_burial',
        'age',
        'status',
        'informant',
        'place',
        'presider',
    ];
}
