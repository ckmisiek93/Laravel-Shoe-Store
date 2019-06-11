<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Cart;
use App\Shoe;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart =  Cart::content();

        return view('cart.cart', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    public function update() {

        $rowId = Input::get('rowId');
        $quantity = Input::get('qty');

        $shoe_cart = Cart::get($rowId);
        $shoe = Shoe::find($shoe_cart->id);
        if ($quantity != $shoe->quantity) {
            return \Redirect::back()->with(['code' => 'danger', 'message' => 'Brak produktu w magazynie']);
        }

        Cart::update($rowId, $quantity);

        return \Redirect::back()->with(['code' => 'success', 'message' => 'Zmieniono ilość produktu w koszyku']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Cart::destroy();

        return back();
    }
    
    //==============================CART FUNCTION==========================================//
    public function cart(Request $request) {
        $id = $request->product_id;
        $product = Shoe::find($id);
        $cartitems =  Cart::content();

        if ($product->quantity == 0) {

            return \Redirect::back()->with(['code' => 'danger', 'message' => 'Brak produktu w magazynie']);

        }

        $CartItem = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price
        ]);

        return \Redirect::back()->with(['code' => 'success', 'message' => 'Dodano produkt do koszyka']);
    }

    public function increment($id, $qty) {

        $rowId = $id;
        $int = intval($qty);
        $increment = $int + 1;
        $shoe_cart = Cart::get($rowId);
        $shoe = Shoe::find($shoe_cart->id);
        if ($increment != $shoe->quantity) {
            return \Redirect::back()->with(['code' => 'danger', 'message' => 'Brak produktu w magazynie']);
        }

        Cart::update($rowId, $increment);

        return \Redirect::back()->with(['code' => 'success', 'message' => 'Dodano produkt do koszyka']);
    }

    public function decrement($id, $qty) {

        $rowId = $id;
        $int = intval($qty);
        $decrement = $int - 1;
        Cart::update($rowId, $decrement);

        return \Redirect::back()->with(['code' => 'success', 'message' => 'Usunięto produkt z koszyka']);
    }

    public function remove($id) {

        $rowId = $id;
        Cart::remove($rowId);

        return \Redirect::back()->with(['code' => 'success', 'message' => 'Usunięto produkt z koszyka']);    }

}

