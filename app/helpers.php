<?php

use App\Invoice;
use App\User;
use App\Rate;
use App\Shoe;


function is_user_admin() {
	$user = User::findorFail(Auth::id());
	if ($user->user_type == 'Administrator') {
		return True;
	}
	return False;
}


function Unfinished_Orders() {
    $invoices = Invoice::all();
    $delivery_count = 0;
    foreach ($invoices as $order) {
        if ($order->payment_status == 'Completed') {
            if ($order->delivery == 0) {
                $delivery_count++;
            }
        }
    }

    return $delivery_count;
}

function invoice_has_rate($invoice_id, $shoe_id) {
    $exist = Rate::where([
        'invoice_id' => $invoice_id,
        'shoe_id' => $shoe_id,
    ])->exists();
    if ($exist == true) {
        $get = Rate::where([
            'invoice_id' => $invoice_id,
            'shoe_id' => $shoe_id,
        ])->first();
        $rating = $get->rate;
        return $rating;
    }
    return false;
}

function shoe_explode($shoe_ids) {
    $pieces = explode(',', $shoe_ids);
    return $pieces;
}

function user_possible_rates() {
    $invoices = Invoice::where([
        'user_id' => Auth::id(),
    ])->get();
    $count = 0;
    foreach ($invoices as $order) {
        foreach(shoe_explode($order->shoe_ids) as $explosion) {
            if ($order->delivery == 1) {
                if (invoice_has_rate($order->id, $explosion) == false) {
                    $count++;
                }
            }
        }
    }
    if ($count == 0) {
        return null;
    }
    return $count;
}

function shoe_rates_available($shoe_id) {
    $rates = Rate::where([
        'shoe_id' => $shoe_id,
    ])->get();

    if ($rates == null) {
        return false;
    }
    return true;
}

function find_shoe($shoe_id) {
    $shoe = Shoe::findorFail($shoe_id);

    return $shoe;
}

function find_user($user_id) {
    $user = User::findorFail($user_id);

    return $user;
}
function user_rate_stats($user_id) {

    $rates = Rate::where([
        'user_id' => $user_id,
    ])->get();
    $invoices = Invoice::where([
        'user_id' => $user_id,
    ])->get();
    $invoice_count = $invoices->count();
    $count = $rates->count();
    $sum = 0;
    $one_star = 0;
    $two_star = 0;
    $three_star = 0;
    $four_star = 0;
    $five_star = 0;

    foreach ($rates as $rate) {
        $sum = $sum + $rate->rate;
        if ($rate->rate == 1) {
            $one_star++;
        } elseif ($rate->rate == 2) {
            $two_star++;
        } elseif ($rate->rate == 3) {
            $three_star++;
        } elseif ($rate->rate == 4) {
            $four_star++;
        } elseif ($rate->rate == 5) {
            $five_star++;
        }
    }

    if ($sum != 0) {
        $avg_rate = $sum/$count;
        $star_display = round($avg_rate*2) / 2;
        $one_percentage = (($one_star/$count) * 100);
        $two_percentage = (($two_star/$count) * 100);
        $three_percentage = (($three_star/$count) * 100);
        $four_percentage = (($four_star/$count) * 100);
        $five_percentage = (($five_star/$count) * 100);
        $collection = collect([
            0 => ['number' => 1, 'count' => $one_star],
            1 => ['number' => 2, 'count' => $two_star],
            2 => ['number' => 3, 'count' => $three_star],
            3 => ['number' => 4, 'count' => $four_star],
            4 => ['number' => 5, 'count' => $five_star],
        ]);
        $max = $collection->where('count', $collection->max('count'))->first();
        $common_rate = $max['number'];

    } elseif ($sum == 0) {
        $avg_rate = -10;
        $star_display = -10;
        $one_percentage = 0;
        $two_percentage = 0;
        $three_percentage = 0;
        $four_percentage = 0;
        $five_percentage = 0;
        $common_rate = 0;
    }   

    $stats = collect([
        'count' => $count, 
        'avg_rate' => $avg_rate, 
        'one_star' => $one_star, 
        'two_star' => $two_star, 
        'three_star' => $three_star, 
        'four_star' => $four_star, 
        'five_star' => $five_star,
        'star_display' => $star_display,  
        'invoice_count' => $invoice_count,  
        'one_percentage' => $one_percentage, 
        'two_percentage' => $two_percentage, 
        'three_percentage' => $three_percentage, 
        'four_percentage' => $four_percentage, 
        'five_percentage' => $five_percentage,
        'common_rate' => $common_rate, 
    ]);
    return $stats;
}
