<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaptismalRecord extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'Birth_Date',
        'Baptism_Date',
        'Fathers_Name',
        'Mothers_Name',
        'Church_Name',
        'Sponsor',
        'Secondary_Sponsor',
        'Priest_Name',
        'Book_Number',
        'Page_Number',
        'Line_Number',
    ];
}
