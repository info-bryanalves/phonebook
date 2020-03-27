<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\User;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $request->session()->put('form', 'signin');

        $validator = Validator::make($request->all(), [
            'signin_email' => 'required|email',
            'password' => 'required',
        ], [            
            'signin_email.required' => 'Preencha seu e-mail',
            'signin_email.email' => 'E-mail inválido',
            'password.required' => 'Preencha sua senha'
        ]);

        if ($validator->fails()) {
            return back()->withInput($request->all())->withErrors($validator);
        }
        
        $user = User::where('email', $request->signin_email)->first();

        if (!$user) {
            return back()->withInput($request->all())->withErrors(['msg' => 'Este usuário não existe!']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withInput($request->all())->withErrors(['msg' => 'Senha inválida!']);
        }
        
        $request->session()->forget('form');

        $request->session()->put('auth.id', $user->id);
        $request->session()->put('auth.name', $user->name);
        $request->session()->put('auth.email', $user->email);
        $request->session()->put('auth.occupation', $user->occupation);
    }
}
