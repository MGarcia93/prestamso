<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Login;

class usuarioController extends Controller
{
    public function create()
    {
        return view("usuario.create");
    }
    public function login()
    {
        return view("usuario.login");
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevo=new Login;
        $nuevo->USER=$request->usuario;
        $nuevo->PASS=bcrypt($request->pass);
        if ($nuevo->save()) {
            session(['usuarop' => $nuevo->USER]);
            return redirect()->action("menuController@index");
        }
    }


    public function validation(Request $request)
    {
        $usuario=Login::where("USER",$request->user)->get();
        if (Hash::check($request->pass,$usuario->PASS)) {
            session(['usuarop' => $nuevo->USER]);
            return rederict()->action("menuController@index");
        }
        else {
            return "pass incorecta";
            die();
        }
    }

   
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

}
