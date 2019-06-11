<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Rate;
use App\User;
use App\Shoe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class RatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_rates_index($user_id) {
        $rates = Rate::where([
            'user_id' => $user_id,
        ])->get();
        $user = User::findorFail($user_id);

        return view('users.rates', compact('rates'))->with(compact('user'));
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($invoice_id, $shoe_id)
    {
        $invoice = Invoice::findorFail($invoice_id);
        $shoe = Shoe::findorFail($shoe_id);
        return view('rates.create', compact('invoice'))->with(compact('shoe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|string|min:5|max:500',
        ]);
        if (invoice_has_rate($request->invoice_id, $request->shoe_id) == true) {
            abort(403, 'Zamówienie ma już ocene');   
        } 

        Rate::create([
            'user_id' => $request->user_id,
            'shoe_id' => $request->shoe_id,
            'invoice_id' => $request->invoice_id,
            'rate' => $request->rate,
            'comment' => $request->comment,
        ]);
        
        return back()->with(['code' => 'success', 'message' => 'Sukces']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
