<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// import thu vien nay dung de login
use Illuminate\Support\Facades\Auth;

use App\User;

class UserController extends Controller
{
    //
    public function getList(){
        $user = User::all();
        return view('admin.user.list',['user'=>$user]);
    }

    //
    public function getEdit($id){
      $user = User::find($id);
      return view('admin/user/edit',['user'=>$user]);
    }

    //
    public function postEdit(Request $request, $id){
    	$this->validate($request,
            [
                'name'=>'required|min:3'
            ],
            [
                'name.required'=>'Please enter your name',
                'name.min'=>'Name must be at least 3 characters'
            ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->quyen = $request->quyen;

        if($request->changePassword == "on"){
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
                'passwordAgain.required'=>'Please enter your password again',
                'passwordAgain.same'=>'Passwords again not like password'
            ]);

            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('admin/user/edit/'.$id)->with('thongbao','You edit success');
    
    }

    //
    public function getAdd(){
       return view('admin.user.add');
    }

    //
    public function postAdd(Request $request){
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
        $user->quyen = $request->quyen;
        $user->save();

        return redirect('admin/user/add')->with('thongbao','You add success');

    }

    //
    public function getDelete($id){
        $user = User::find($id);
        $user->delete();

        return redirect('admin/user/list')->with('thongbao','You delete success');
    }

    // Ham login with admin
    public function getLoginAdmin(){
        return view('admin.login');
    }

    public function postLoginAdmin(Request $request){
 
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

            return redirect('admin/user/list');
        }else{
            return redirect('admin/login')->with('thongbao','Login unsuccessful...!!!');
        }
    }

    // Ham logout
    public function getLogoutAdmin(){
        Auth::logout();

        return redirect('admin/login');
    }
}
