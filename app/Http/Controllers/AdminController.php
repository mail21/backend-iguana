<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function login_admin(Request $request)
    {
        $findAdmin = Admin::find($request->username);

        if($findAdmin){
            if($findAdmin->username == $request->username && $findAdmin->password == $request->password){
                return response()->json(['status' => true,'pesan' => "login sukses"], 200);
            }
            return response()->json(['status' => false,'pesan' => "Username/Password Salah"], 200);
        }
        return response()->json(['status' => false,'pesan' => "Username Tidak Ditemukan"], 200);
    }

    public function login_user(Request $request)
    {
        $findUser = User::find($request->username);

        if($findUser){
            if($findUser->username == $request->username && $findUser->password == $request->password){
                return response()->json(['status' => true,'pesan' => "login sukses"], 200);
            }
            return response()->json(['status' => false,'pesan' => "Username/Password Salah"], 200);
        }
        return response()->json(['status' => false,'pesan' => "Username Tidak Ditemukan"], 200);
    }

    public function registrasi_user(Request $request)
    {
        $findUser = User::find($request->username);

        if($findUser){
            return response()->json(['status' => false,'pesan' => "Username Sudah Ada"], 200);
        }

        $dataUsername = new User;
        $dataUsername->username = $request->username;
        $dataUsername->password = $request->password;
        $dataUsername->nama = $request->nama;
        $dataUsername->save();
        return response()->json(['status' => true,'pesan' => "Sukses"], 200);
    }

}
