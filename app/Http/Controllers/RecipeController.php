<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipe=Recipe::all();
        return response()->json($recipe);
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
            $recipe=new Recipe();
            $recipe->judul=$request->judul;
            $recipe->tanggal=$request->tanggal;

            $dir = 'uploads/';
            $extension = strtolower($request->file('foto')->getClientOriginalExtension());
            $fileName = str_random() . '.' . $extension;
            $request->file('foto')->move($dir, $fileName);
            $recipe->foto = $fileName;

            $recipe->konten=$request->konten;
            $recipe->user_id=$request->user_id;

            $success=$recipe->save();

            if($success)
                return response()->json(['message'=>'Recipe berhasil dibuat'], 201);
            else
                return response()->json(['message'=>'Gagal membuat recipe'], 500);
        }
        else{
            return response()->json(['message'=>'Gagal membuat recipe'], 500);
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
        $recipe=Recipe::find($id);
        if(is_null($recipe))
            return response()->json(['message'=>'Recipe tidak ditemukan'], 404);
        else
            return response()->json($recipe, 200);
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
        $recipe=Recipe::find($id);
        if(is_null($recipe))
            return response()->json(['message'=>'Recipe tidak ditemukan'], 404);
        else{
            $recipe->judul=$request->judul;
            $recipe->tanggal=$request->tanggal;
            if($request->hasFile('foto'))
            {
                $dir = 'uploads/';
                $extension = strtolower($request->file('foto')->getClientOriginalExtension());
                $fileName = str_random() . '.' . $extension;
                $request->file('foto')->move($dir, $fileName);
                $recipe->foto = $fileName;
            }
            $recipe->konten=$request->konten;
            $success=$recipe->save();
            if($success)
                return response()->json(['message'=>'Recipe berhasil diupdate'], 201);
            else
                return response()->json(['message'=>'Gagal mengupdate recipe'], 500);
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
        $recipe=Recipe::find($id);
        if(is_null($recipe))
            return response()->json(['message'=>'Recipe tidak ditemukan'], 404);
        else
        {
            $success=$recipe->delete();
            if($success)
                return response()->json(['message'=>'Recipe berhasil dihapus'], 200);
            else
                return response()->json(['message'=>'Gagal menghapus recipe'], 500);
        }
    }
}
