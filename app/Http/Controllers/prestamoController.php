<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamo;
use App\Cliente;

class prestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id= Prestamo::max('ID');
        $clientes=Cliente::all();
        return view("prestamo.generar")->with([
            "id"=>$id,
            "clientes"=>$clientes
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevo= new Prestamo;
        $nuevo->FECHA=$request->fechaPrestamo;
        $nuevo->PRESTADOR=$request->prestador;
        $nuevo->MONTONUM=$request->cantNumero;
        $nuevo->MONTOLETRA=$request->cantLetra;
        $nuevo->DURACION=$request->duracion;
        $nuevo->CUOTAS=$request->cuotas;
        $nuevo->ESTADO=1;
        $nuevo->IDCLIENTE=$request->cliente;
        if($nuevo->save()){
            return redirect()->action(
            "prestamoController@create",["save",1]
            );
        }
        else{
            return redirect()->action(
            "prestamoController@create",["save",0]
            );   
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
        $prestamo= Prestamo::find($id);
        return $prestamo;
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
    }
}
