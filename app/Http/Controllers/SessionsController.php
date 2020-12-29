<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create(){
        return view('login');
    }

    public function store(){
        $this->validate(request(),[
            'email'=>'required|email',
            'password'=>'required'
        ]); 

        if(! auth()->attempt(request(['email','password']))){
            return back()->withErrors([
                'message'=>'ثمة خطأ في اسم المرور أو الباسورد'
            ]);
        }
        return redirect('home');
    }

    public function destroy(){
        auth()->logout();
        return redirect('/');
    }

}
