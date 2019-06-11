<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shoe;
use App\User;
use App\Rate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ShoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shoe = Shoe::all();
        return view('home', compact('shoe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_user_admin() == False) {
            abort(403, 'Uzytkownik nie ma dostępu do tego panelu');
        }
        return view('shoes.create');
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
            'name' => 'required|string|max:40',
            'price' => 'required|integer',
            'description' => 'required|string|max:255',
            'size' => 'required|string|max:10',
            'colour' => 'required|string|max:255',
            'quantity' => 'required|string|max:255',
            'target' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        if (is_user_admin() == True) {
            Shoe::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'size' => $request->size,
                'colour' => $request->colour,
                'quantity' => $request->quantity,
                'target' => $request->target,
                'brand' => $request->brand,
            ]);

            return redirect('/shoes/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shoe = Shoe::FindorFail($id);
        $rates = Rate::where([
            'shoe_id' => $id,
        ])->get();

        return view('shoes.show', compact('shoe'))->with(compact('rates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shoe = Shoe::FindorFail($id);

        if (is_user_admin() == False) {
            abort(403, 'Uzytkownik nie ma dostępu do tego panelu');
        }
        return view('shoes.edit', compact('shoe'));

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
        $this->validate($request, [
            'name' => 'required|string|max:40',
            'price' => 'required|integer',
            'description' => 'required|string|max:255',
            'size' => 'required|string|max:10',
            'colour' => 'required|string|max:255',
            'quantity' => 'required|string|max:255',
            'target' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        $shoe = Shoe::find($id);
        $shoe->name = $request->name;
        $shoe->price = $request->price;
        $shoe->description = $request->description;
        $shoe->size = $request->size;
        $shoe->colour = $request->colour;
        $shoe->quantity = $request->quantity;
        $shoe->target = $request->target;
        $shoe->brand = $request->brand;

        if ($request->file('image')) {
            $shoe_image_path = 'public/shoes/' . $id . '/images';
            $upload_path = $request->file('image')->store($shoe_image_path);
            $shoe_filename = str_replace($shoe_image_path . '/', '', $upload_path);
            $shoe->image = $shoe_filename;
        }
        
        $shoe->save();

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
        $boot = Shoe::FindorFail($id);
        if (is_user_admin() == False) {
            abort(403, 'Uzytkownik nie może usuwać obuwia');
        }
        Shoe::where([
            'id' => $id
        ])->delete();

        return redirect('/home');
    }
    public function increment($id) {
        if (is_user_admin() == False) {
            abort(403, 'Uzytkownik nie może dokonać tej czynności');
        }
        $shoe = Shoe::find($id);
        $q = $shoe->quantity + 1;
        $shoe->quantity = $q;
        $shoe->save();
        return \Redirect::back()->with(['code' => 'success', 'message' => 'Zwiększono ilość produktu: ' . $shoe->name]);
    }

    public function decrement($id) {
        if (is_user_admin() == False) {
            abort(403, 'Uzytkownik nie może dokonać tej czynności');
        }
        $shoe = Shoe::find($id);
        if ($shoe->quantity == 0) {
            return \Redirect::back()->with(['code' => 'danger', 'message' => 'Nie można zmniejszyć ilości produktu: ' . $shoe->name]);
        }
        $q = $shoe->quantity - 1;
        $shoe->quantity = $q;
        $shoe->save();
        return \Redirect::back()->with(['code' => 'success', 'message' => 'Zwiększono ilość produktu: ' . $shoe->name]);
    }

}
