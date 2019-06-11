<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
 	protected $table = 'shoes';

    protected $fillable = [
        'name', 'price', 'description', 'size', 'colour', 'quantity', 'image', 'target', 'brand'
    ];

    
    public function shoe_rates()
    {
        return $this->hasMany('App\Rate');
    }
    public function shoe_invoices()
    {
        return $this->hasMany('App\Invoice');
    }

}