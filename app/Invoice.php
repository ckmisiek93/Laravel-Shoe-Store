<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'title', 'price', 'adress', 'user_id', 'shoe_ids', 'payment_status', 'delivery'
    ];

    public function getPaidAttribute() {
		if ($this->payment_status == 'Invalid') {
			return false;
		}
	return true;
    }


    public function invoice_rate()
    {
        return $this->hasOne('App\Rate');
    }

}
