<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encargo;
use App\Models\User;


class EncargosController extends Controller
{
    public function index()
    {
    	//retorna todos os encargos
    	$encargos = Encargo::all();

    	return view('encargos.lista', ['encargos' => $encargos]);
    }

    public function novo(Request $request)
    {
    	$encargo = new Encargo;

    	$encargo->nome = $request->nome;
    	$encargo->descricao = $request->descricao;
    	$encargo->valor = $request->valor;
    	$encargo->data_compra = $request->data_compra;
    	$encargo->data_pagto = $request->data_pagto;
    	$encargo->forma_pagto = $request->forma_pagto;

        $user = auth()->user();  //dá acesso ao usuário logado
        $encargo->user_id = $user->id;

    	$encargo->save();

    	return redirect('/encargos')->with('msg', 'Encargo cadastrado!');
    }

    public function ver($id)
    {
        $encargo = Encargo::findOrFail($id);

        $encargoCad = User::where('id', $encargo->user_id)->first()->toArray();

        return view('encargos.ver', ['encargo' => $encargo, 'encargoCad' => $encargoCad]);
    }

    public function editar(Request $request)
    {
        Encargo::findOrFail($request->id)->update($request->all());
        return redirect('/encargos')->with('msg', 'Encargo Editado!.');
    }

    public function apagar($id)
    {
        Encargo::findOrFail($id)->delete();

        return redirect('/encargos')->with('msg', 'Encargo excluído.');
    }
}
