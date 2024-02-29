<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function registracija(Request $request){

        $data = $request->validate([
            'ime' => 'required',
            'prezime' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'uloga' => ''
        ],
        [
            'ime.required' => 'Ime je obavezno polje',
            'prezime.required' => 'Prezime je obavezno polje',
            'email.required' => 'Email je obavezno polje',
            'email.email' => 'Email nije u ispravnom formatu',
            'email.unique' => 'Postoji korisnik sa ovom email adresom',
            'password.required' => 'Lozinka je obavezno polje'
        ]
        );

        $data['password'] = bcrypt($data['password']);
        $data['uloga'] = 'korisnik';
        $user = new User();
        $user->create($data);
        return response()->json(['message' => 'Registracija je uspješna'], 201);


    }

    public function prijava(Request $request){

        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ],
        [
            'email.required' => 'Email je obavezno polje',
            'email.email' => 'Email nije u ispravnom formatu',
            'password.required' => 'Lozinka je obavezno polje'
        ]
        );



        if (Auth::attempt($data)) {
            $user = Auth::user();
            return response()->json(['message' => 'Uspjesna prijava', 'user' => $user]);
        } else {
            return response()->json(['message' => 'Neuspjesna prijava']);
        }

    }

    public function prijavljen(){
        $user = Auth::user();
        return response()->json(['user' => $user]);
    }

    public function odjava(){
        Auth::logout();
        return response()->json(['message' => 'Uspjesna odjava']);
    }
}
