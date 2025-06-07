<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'year',
        'date_of_marriage',
        'husband_name',
        'wife_name',
        'husband_status',
        'wife_status',
        'husband_age',
        'wife_age',
        'municipality',
        'barangay',
        'husband_parents',
        'wife_parents',
        'sponsor1',
        'sponsor2',
        'place_of_sponsor',
        'presider',
    ];
}
