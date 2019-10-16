<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMailable;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user=User::all();
        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cek=User::where('email', $request->email)->get();
        if($cek->count()>0)
            return response()->json(['message'=>'Email tersebut telah terdaftar'], 202);

        $user=new User();
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->email_token=str_random(10);

        $success=$user->save();

        if($success)
        {
            Mail::to($user->email)->send(new SendMailable($request->email));
            return response()->json(['message'=>'User berhasil dibuat'], 201);
        }
        else
            return response()->json(['message'=>'Gagal membuat user'], 500);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user=User::find($id);
        if(is_null($user))
            return response()->json(['message'=>'User tidak ditemukan'], 404);
        else
            return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user=User::find($id);
        if(is_null($user))
            return response()->json(['message'=>'User tidak ditemukan'], 404);
        else{
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;

            if(!is_null($request->password))
                $user->password=Hash::make($request->password);

            $success=$user->save();

            if($success)
                return response()->json(['message'=>'User berhasil diedit'], 200);
            else
                return response()->json(['message'=>'Gagal mengedit user'], 500);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user=User::find($id);
        if(is_null($user))
            return response()->json(['message'=>'User tidak ditemukan'], 404);
        else
        {
            $success=$user->delete();
            if($success)
                return response()->json(['message'=>'User berhasil dihapus'], 200);
            else
                return response()->json(['message'=>'Gagal menghapus user'], 500);
        }
    }


    public function login(Request $request)
    {
        $user=User::where('email',$request->email)->first();
        if($user){
            if (Hash::check($request->password, $user->password)){
                if($user->email_verified_at==null)
                    return response()->json(['message'=>'Akun belum diverifikasi'], 202);
                else
                    return response()->json(['message'=>'Email dan Password benar', 'user'=> $user], 200);
            }else{
                return response()->json(['message'=>'Password salah'], 202);
            }
        }else{
            return response()->json(['message'=>'Email salah'], 202);
        }
    }

    public function verifikasi($email_token)
    {
        $user=User::where('email_token', $email_token)->where('email_verified_at',null)->first();
        if(!is_null($user)){
            $user->email_verified_at=Carbon::now();
            $success=$user->save();
            if($success){
                return redirect('/login?scs=Verifikasi akun Anda berhasil');
            }
            else
                return redirect('/login?msg=Verifikasi akun Anda gagal');
        }
        else{
            return redirect('/login?msg=Akun sudah diverifikasi');
        }
    }
}
