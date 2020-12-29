<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class RegistrationController extends Controller
{
    public function create(){
        return view('register');
    }

    public function store(Request $request){
        
        $this->validate(request(),[
            'name'=>'required',
            'email'=>'required | email',
            'password'=>'required',
            'balance'=>'max:4'
        ]);

        $user = User::create([
            'name'=>request('name'),
            'email'=>request('email'),
            'password'=>bcrypt(request('password')),
            'balance'=>request('balance')
        ]);
        
            $user->roles()->attach(Role::where('name','user')->first());

        //auth()->login($user);
        
        return back()->with('status', 'تم تسجيل مستخدم جديد بنجاح (:');
    }

    public function edite($id){
        $user = User::find($id);
        return view('editeuser', compact('user'));
    }

    public function update(Request $request,$id){
        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->balance = $user->balance + $request['balance'];
        $user->save();
        return redirect('home/users');
    }

    public function editeBalance($id){
        $user = User::find($id);
        return view('addbalance', compact('user'));
    }

    public function updateBalance(Request $request,$id){
        $user = User::find($id);
        $user->balance = $user->balance + $request['balance'];
        $user->save();
        return redirect('home/users');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return back();
    }
}
