<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    public function dodajKategoriju(Request $request){

        $data = $request->validate([
            'user_id' => '',
            'ime' => 'required',
            'opis' => 'required',

        ],
        [
            'ime.required' => 'Ime je obavezno polje',
            'opis.required' => 'Opis je obavezno polje',
        ]
        );

        $data['user_id'] = auth()->id();
        $kategorija = new Category();
        $kategorija->create($data);
        return response()->json(['poruka' => 'Kategorija uspješno dodana'], 201);
    }

    public function kategorije(){
        $kategorije = Category::with('user')->get();
        return response()->json(['kategorije' => $kategorije]);
    }

    public function izbrisiKategoriju($id){
        $kategorija = Category::find($id);
        $kategorija->delete();
        return response()->json(['poruka' => 'Kategorija uspješno izbrisana'], 201);
    }

}
