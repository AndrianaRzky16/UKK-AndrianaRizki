<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spp;

class sppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Spp::all();
        return view('admin.spp.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.spp.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Spp::create([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);
        return redirect('spp')->with('success', 'Berhasil di input');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Spp $spp)
    {
        return view('admin.spp.edit', compact('spp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spp $spp)
    {
        $request->validate([
            'tahun' => 'required | string',
            'nominal' => 'required | string'
        ]);

        $spp->update([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);

        return redirect('spp')->with('success', 'Data Spp Berhasil Diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spp $spp)
    {
        $spp->delete();
        return redirect()->route('spp.index');
    }
    // public function destroy(Spp $spp)
    // {
    //     $spp->delete();
    //     return redirect('spp')->with([
    //         'Yeay'
    //     ]);
    // }
}
