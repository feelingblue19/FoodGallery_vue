<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $review=Review::all();
        return response()->json($review);
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
            $review=new Review();
            $review->judul=$request->judul;
            $review->lokasi=$request->lokasi;
            $review->tanggal=$request->tanggal;
            $review->harga=$request->harga;

            $dir = 'uploads/';
            $extension = strtolower($request->file('foto')->getClientOriginalExtension());
            $fileName = str_random() . '.' . $extension;
            $request->file('foto')->move($dir, $fileName);
            $review->foto = $fileName;

            $review->konten=$request->konten;
            $review->user_id=$request->user_id;

            $success=$review->save();

            if($success)
                return response()->json(['message'=>'Review berhasil dibuat'], 201);
            else
                return response()->json(['message'=>'Gagal membuat review'], 500);
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
        $review=Review::find($id);
        if(is_null($review))
            return response()->json(['message'=>'Review tidak ditemukan'], 404);
        else
            return response()->json($review, 200);
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
        $review=Review::find($id);
        if(is_null($review))
            return response()->json(['message'=>'Review tidak ditemukan'], 404);
        else{

            $review->judul=$request->judul;
            $review->lokasi=$request->lokasi;
            $review->tanggal=$request->tanggal;
            $review->harga=$request->harga;
            if($request->hasFile('foto'))
            {
                $dir = 'uploads/';
                $extension = strtolower($request->file('foto')->getClientOriginalExtension());
                $fileName = str_random() . '.' . $extension;
                $request->file('foto')->move($dir, $fileName);
                $review->foto = $fileName;
            }

            $review->konten=$request->konten;
            $success=$review->save();
            if($success)
                return response()->json(['message'=>'Review berhasil diupdate'], 201);
            else
                return response()->json(['message'=>'Gagal mengupdate review'], 500);
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
        $review=Review::find($id);
        if(is_null($review))
            return response()->json(['message'=>'Review tidak ditemukan'], 404);
        else
        {
            $success=$review->delete();
            if($success)
                return response()->json(['message'=>'Review berhasil dihapus'], 200);
            else
                return response()->json(['message'=>'Gagal menghapus review'], 500);
        }
    }
}
