<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Invoice;
use App\User;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        if (intval($user_id) !== Auth::id()) {
            abort(403, 'Brak dostępu do zamówień użytkownika');
        }
        $user = User::findorFail($user_id);

        $orders = $user->invoices;
        return view('orders.index', compact('orders'))->with(compact('user'));
    }
    public function administratorindex()
    {

        if (is_user_admin() == False) {
            abort(403, 'Uzytkownik nie ma dostępu do tego panelu');
        }
        $orders = Invoice::all();
        return view('orders.orders', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::findorFail(Auth::id());
        $invoice = Invoice::findorFail($id);

        if (is_user_admin() == false) {
            abort(403, 'Tylko administrator może to zrobic');
        }
        $invoice->delivery = $request->confirmed;
        $invoice->save();
        
        return back();

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
