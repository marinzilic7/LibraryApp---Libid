<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function dodajKosaricu($id){
        $korisnik = Auth::user();
        $jelPostoji = Cart::where('user_id', $korisnik->id)
                                 ->where('book_id', $id)
                                 ->first();
        if ($jelPostoji) {
            return response()->json(['poruka' => 'Već ste dodali ovu knjigu'], 400);
        }
        $cart = Cart::create([
            'book_id' => $id,
            'user_id' => $korisnik->id,

        ]);

        return response()->json(['poruka' => 'Uspješno dodano u korpu!']);
    }
}
