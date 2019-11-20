<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function submitRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        DB::beginTransaction();
        try {
            //simpan data login
            $User = new User;
            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = Hash::make($request->password);
            $User->save();

            DB::commit();
            return redirect()->route('login')->with('message','Kustomer berhasil terdaftar');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('satker.index')->with('message','Data gagal tersimpan');
        }
    }

    public function submitLogin(Request $request)
    {
        //cek apakah user terdaftar
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('customer.index');
        }

        return redirect()->route('login')->with('message','Login gagal. Cek kembali email dan password yang anda masukkan');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('public.index');
    }
}
