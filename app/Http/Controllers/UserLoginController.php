<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import thu vien nay dung de login
use Illuminate\Support\Facades\Auth;
use App\User;

class UserLoginController extends Controller
{
	

    //
    function getLogin(){

    	return view('pages.login');
    }

    function postLogin(Request $request){

    	$this->validate($request,
            [
                'email'=>'required',
                'password'=>'required'
            ],
            [
                'email.required'=>'Email is not empty',
                'password.required'=>'Passwords is not empty'
            ]); 

    	if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){

            return redirect('home');
        }else{
            return redirect('login')->with('thongbao','Login unsuccessful...!!!');
        }
    }

    function getLogout(){
    	Auth::logout();
    	return redirect('home');
    }

    function getAccount(){
    	$user = Auth::user();
    	return view('pages.account',['user'=>$user]);
    }

    function postAccount(Request $request){
    	$this->validate($request,
            [
                'name'=>'required|min:3'
            ],
            [
                'name.required'=>'Please enter your name',
                'name.min'=>'Name must be at least 3 characters'
            ]);

        $user = Auth::user();
        $user->name = $request->name;

        if($request->checkpassword == "on"){
            $this->validate($request,
            [
                'password'=>'required|min:3|max:32',
                // same-> kiem tra passwordAgain co giong voi password
                'passwordAgain'=>'required|same:password'
            ],
            [
                'password.required'=>'Please enter your password',
                'password.min'=>'Password must be at least 3 characters',
                'password.max'=>'Passwords of up to 32 characters',
                // 'passwordAgain.required'=>'Please enter your password again',
                'passwordAgain.same'=>'Passwords again not like password'
            ]);
            // bcrypt dung de ma hoa mat khau trong laravel
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('account')->with('thongbao','You edit success');
    }

    function getRegister(){
    	return view('pages.register');
    }

    function postRegister(Request $request){
    	$this->validate($request,
            [
                'name'=>'required|min:3',
                // kiem tra email k rong, k duoc trung trong table users voi field email, no co phai la email?
                'email'=>'required|unique:users,email|email',
                'password'=>'required|min:3|max:32',
                // same-> kiem tra passwordAgain co giong voi password
                'passwordAgain'=>'required|same:password'
            ],
            [
                'name.required'=>'Please enter your name',
                'name.min'=>'Name must be at least 3 characters',
                'email.required'=>'Please enter your email',
                'email.unique'=>'Email is exits',
                'email.email'=>'Email invalidate',
                'password.required'=>'Please enter your password',
                'password.min'=>'Password must be at least 3 characters',
                'password.max'=>'Passwords of up to 32 characters',
                'passwordAgain.required'=>'Please enter your password again',
                'passwordAgain.same'=>'Passwords again not like password'
            ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = 0;
        $user->save();

        return redirect('register')->with('thongbao','You register success');
    }
}
