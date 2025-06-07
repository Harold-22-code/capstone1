<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmationRecord extends Model
{
    use HasFactory;
     protected $fillable = [
        'year',
        'date_of_confirmation',
        'name',
        'parish_of_baptism',
        'province_of_baptism',
        'place_of_baptism',
        'parents',
        'sponsor',
        'name_of_minister',
    ];
}
