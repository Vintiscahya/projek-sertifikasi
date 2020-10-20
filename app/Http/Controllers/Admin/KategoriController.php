<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\kategori;
use App\Taks;
use Illuminate\Http\Request;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagename = 'Data Kategori';
        $data = kategori::all();
        return view('admin.kategori.index',compact('data','pagename'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data_kategori = kategori::all();
        $pagename='Form Input Kategori';
        return view('admin.kategori.create', compact('pagename','data_kategori'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'txtnama_kategori'=>'required',
            'radiostatus_kategori'=>'required',
           ]);
    
           $data_kategori=new Kategori([
               'nama_kategori'=> $request->get('txtnama_kategori'),
               'status_kategori'=> $request->get('radiostatus_kategori'),
           ]);
    
           $data_kategori->save();
           return redirect('admin/kategori')->with('succes','data berhasil disimpan');
     
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
    public function edit($id)
    {
        //
        $data_kategori=kategori::all();
        $pagename='Update Kategori';
        $data=Kategori::find($id);
        return view ('admin.kategori.edit', compact('data','pagename','data_kategori'));
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
        $request->validate([
            'txtnama_kategori'=>'required',
            'radiostatus_kategori'=>'required'
           ]);
    
          $kategori=Kategori::find($id);
              $kategori->nama_kategori = $request->get('txtnama_kategori');
              $kategori->status_kategori= $request->get('radiostatus_kategori');
          
           $kategori->save();
           return redirect('admin/kategori')->with('succes','data berhasil diupdate');
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
        $kategori=Kategori::find($id);

        $kategori->delete();
        return redirect('admin/kategori')->with('succes','data berhasil dihapus');

    }
}
