<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repodos extends Model
{
    protected $visible = [
        'row',
        'customer',
        'from',
        'to',
        'bkg',
        'cabin',
        'class',
        'seat',
        'accept',
        'codeshare',
        'incarriage',
        'incarriagefrom',
        'arrivaltime',
        'bagdetails',
    ];

}
