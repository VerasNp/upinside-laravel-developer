<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /**
         * =============================================================================================================
         * ONE TO ONE RELATIONSHIP
         */
        $address = Address::find($id);
        echo "<h1>Endereço de entrega</h1>";
        echo "Endereço: {$address->address}, {$address->number}";
        echo "<br>";
        echo "Complemento: {$address->complement}, CEP: {$address->zipcode}";
        echo "<br>";
        echo "Cidade/Estado: {$address->city}/{$address->state}";

        // To access the relationship calls it like an method, it will be returned an collection!
        $user = $address->user()->get()->first();
        if ($user) {
            echo "<h1>Dados do usuário</h1>";
            echo "<br>";
            echo "Nome: {$user->name}";
            echo "<br>";
            echo "E-mail: {$user->email}";
        }
        /**
         * =============================================================================================================
         */
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
