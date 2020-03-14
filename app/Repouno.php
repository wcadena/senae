<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repouno extends Model
{
    //
    protected $visible = [
        'row',
        'customer',
        'seat',
        'accept',
        'regulatoryinformation'
    ];
}
