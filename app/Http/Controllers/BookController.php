<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function dodajKnjigu(Request $request){

        $data = $request->validate([
            'user_id' => '',
            'category_id' => 'required',
            'ime' => 'required',
            'opis' => 'required',
            'autor' => 'required',
            'godina_izdanja' => 'required',
            'cijena' => 'required',
            'image' => 'required'
        ],
        [
            'ime.required' => 'Ime je obavezno polje',
            'opis.required' => 'Opis je obavezno polje',
            'autor.required' => 'Autor je obavezno polje',
            'godina_izdanja.required' => 'Godina izdanja je obavezno polje',
            'cijena.required' => 'Cijena je obavezno polje',
            'image.required' => 'Slika knjige je obavezna',
            'category_id.required' => 'Kategorija je obavezno polje',

        ]);

        $data['user_id'] = auth()->id();
        $data['created_at'] = now();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }

        DB::table('books')->insert($data);
        return response()->json(['message' => 'Uspjesno dodano'], 201);

    }

    public function dohvatiKnjige(){
        $knjige = Book::with('user','category')->get();
        return response()->json(['knjige' => $knjige]);
    }

    public function izbrisiKnjigu($id){
        $knjiga = Book::find($id);
        $knjiga->delete();
        return response()->json(['poruka' => 'Knjiga uspješno izbrisana'], 201);
    }

    public function urediKnjigu(Request $request, $id){
        $knjiga = Book::findOrFail($id);
        $data = $request->validate([
            'ime' => 'required',
            'opis' => 'required',
            'autor' => 'required',
            'godina_izdanja' => 'required',
            'category_id' => 'required',
            'cijena' => 'required',
            'image' => 'required',

        ],
        [
            'ime.required' => 'Ime je obavezno polje',
            'opis.required' => 'Opis je obavezno polje',
            'autor.required' => 'Autor je obavezno polje',
            'godina_izdanja.required' => 'Godina izdanja je obavezno polje',
            'cijena.required' => 'Cijena je obavezno polje',
            'image.required' => 'Slika knjige je obavezna',
            'category_id.required' => 'Kategorija je obavezno polje',
        ]

        );

        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }



        $knjiga->update([
            'ime' => $data['ime'],
            'opis' => $data['opis'],
            'autor' => $data['autor'],
            'godina_izdanja' => $data['godina_izdanja'],
            'category_id' => $data['category_id'],
            'cijena' => $data['cijena'],
            'image' => $data['image']
        ]);

        return response()->json([
            'poruka' => 'Uspjesno uredjeno',
            'knjiga' => $knjiga,
        ]);
    }


}
