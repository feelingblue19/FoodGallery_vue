<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cafe;

class CafeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cafe=Cafe::all();
        return response()->json($cafe);
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
        if($request->hasFile('foto'))
        {
            $cafe=new Cafe();
            $cafe->nama=$request->nama;
            $cafe->lokasi=$request->lokasi;
            $cafe->range_harga=$request->range_harga;

            $dir = 'uploads/';
            $extension = strtolower($request->file('foto')->getClientOriginalExtension());
            $fileName = str_random() . '.' . $extension;
            $request->file('foto')->move($dir, $fileName);
            $cafe->foto = $fileName;

            $cafe->konten=$request->konten;
            $cafe->user_id=$request->user_id;

            $success=$cafe->save();

            if($success)
                return response()->json(['message'=>'Cafe berhasil dibuat'], 201);
            else
                return response()->json(['message'=>'Gagal membuat cafe'], 500);
        }
        else{
            return response()->json(['message'=>'Gagal membuat cafe'], 500);
        }

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
        $cafe=Cafe::find($id);
        if(is_null($cafe))
            return response()->json(['message'=>'Cafe tidak ditemukan'], 404);
        else
            return response()->json($cafe, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $cafe=Cafe::find($id);
        if(is_null($cafe))
            return response()->json(['message'=>'Cafe tidak ditemukan'], 404);
        else{
            $cafe->nama=$request->nama;
            $cafe->lokasi=$request->lokasi;
            $cafe->range_harga=$request->range_harga;
            if($request->hasFile('foto'))
            {
                $dir = 'uploads/';
                $extension = strtolower($request->file('foto')->getClientOriginalExtension());
                $fileName = str_random() . '.' . $extension;
                $request->file('foto')->move($dir, $fileName);
                $cafe->foto = $fileName;
            }
            $cafe->konten=$request->konten;
            $success=$cafe->save();
            if($success)
                return response()->json(['message'=>'Cafe berhasil diupdate'], 201);
            else
                return response()->json(['message'=>'Gagal mengupdate cafe'], 500);
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
        $cafe=Cafe::find($id);
        if(is_null($cafe))
            return response()->json(['message'=>'Cafe tidak ditemukan'], 404);
        else
        {
            $success=$cafe->delete();
            if($success)
                return response()->json(['message'=>'Cafe berhasil dihapus'], 200);
            else
                return response()->json(['message'=>'Gagal menghapus cafe'], 500);
        }
    }
}
