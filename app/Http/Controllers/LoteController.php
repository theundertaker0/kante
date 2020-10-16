<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class LoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lotes=Lote::all();
       return view('lotes.index',compact('lotes'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function show(Lote $lote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function edit(Lote $lote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lote $lote)
    {
       
        switch($request->tipoCambio){
            case 'm2':
              $lote->total=$lote->area*$request->valorCambiar;
              $lote->enganche=$lote->total*0.1;
              $lote->saldo=$lote->total-$lote->enganche;
              $lote->m2=$request->valorCambiar;
               toastr()->success('Lote actualizado correctamente');
              //return redirect()->route('lotes.index')->with('success','Lote actualizado correctamente');
            break;
            case 'msi':
              $lote->promocion=$request->valorCambiar;
              toastr()->success('Lote actualizado correctamente');
            break;
        }
        $lote->update();
        return redirect()->route('lotes.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lote $lote)
    {
        //
    }

    public function setStatus($id,$val){
        $lote=Lote::find($id);
        $lote->update(['status'=>$val]);
        return $lote->status;
    }

    public function verLotesCliente(){
        $lotes=Lote::all();
       return view('lotes.verlotes',compact('lotes'));
    }
}
