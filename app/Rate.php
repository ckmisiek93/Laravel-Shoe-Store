<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'rate', 'comment', 'invoice_id', 'shoe_id', 'user_id'
    ];

}
