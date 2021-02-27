<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $user = User::find($id);
        echo "<h1>Dados do usuário</h1>";
        echo "<br>";
        echo "Nome: {$user->name}";
        echo "<br>";
        echo "E-mail: {$user->email}";

        // To access the relationship calls it like an method, it will be returned an collection!
        $userAddress = $user->addressDelivery()->get()->first();
        if ($userAddress) {
            echo "<h1>Endereço de entrega do usuário</h1>";
            echo "Endereço: {$userAddress->address}, {$userAddress->number}";
            echo "<br>";
            echo "Complemento: {$userAddress->complement}, CEP: {$userAddress->zipcode}";
            echo "<br>";
            echo "Cidade/Estado: {$userAddress->city}/{$userAddress->state}";
        }

        /**
         * =============================================================================================================
         * Its possible to call some methods to make an new data related to the ones that are being searched
         */
        // Thats one way to insert data
        $address1 = new Address([
            'address' => 'Foo567',
            'number' => '0',
            'complement' => 'Apto 234',
            'zipcode' => '000',
            'city' => 'Rio Branco',
            'state' => 'Acre'
        ]);

        // Thats another way to insert data
        $address2 = new Address();
        $address2->address = 'Foo 123';
        $address2->number = '1';
        $address2->complement = 'APTO 9';
        $address2->zipcode = '456';
        $address2->city = 'Rio de Janeiro';
        $address2->state = 'Naaa';

        /**
         * 1º way: the method save()
         * Insert an filled object as parameter to save the new data
         */
        // $user->addressDelivery()->save($address);

        /**
         * 2º way: the method saveMany()
         * Insert an array of filled objects as parameter to save the new data
         */
        // $user->addressDelivery()->saveMany([$address1, $address2]);

        /**
         * 3º way: the method create()
         * Insert an array to save the new data
         * Attention: Susceptible to errors. The data will not be threated in the right way!
         */
        // $user->addressDelivery()->create([
        //     'address' => 'Foo567',
        //     'number' => '0',
        //     'complement' => 'Apto 234',
        //     'zipcode' => '000',
        //     'city' => 'Rio Branco',
        //     'state' => 'Acre'
        // ]);

        /**
         * 4º way: the method createMany()
         * Insert an array to save more than one data at the same time
         * Attention: Susceptible to errors. The data will not be threated in the right way!
         */
        // $user->addressDelivery()->createMany([[
        //     'address' => 'Foo567',
        //     'number' => '0',
        //     'complement' => 'Apto 234',
        //     'zipcode' => '000',
        //     'city' => 'Rio Branco',
        //     'state' => 'Acre'
        // ], [
        //     'address' => 'Foo567',
        //     'number' => '0',
        //     'complement' => 'Apto 234',
        //     'zipcode' => '000',
        //     'city' => 'Rio Branco',
        //     'state' => 'Acre'
        // ]]);

        /**
         * The return of relationship its only invocated if its called to, its possible to change that!
         * The method with(): As a parameter pass an string with the name of the relationship
         * Attention: It can be a bad choice if its worked with a big volume of data!
         */
        // $users = User::with('addressDelivery')->get();
        /**
         * =============================================================================================================
         */

        /**
         * =============================================================================================================
         * ONE TO MANY RELATIONSHIP
         * Attention: In a relationship like this it will be returned an collection and not just one data, use an repeat
         * loop
         */
        $posts = $user->posts()->get();
        if ($posts) {
            echo "<h1>Post do usuário</h1>";
            echo "<br>";
            foreach ($posts as $post) {
                echo "#{$post->id} Titulo: {$post->title}";
                echo "<br>";
                echo "<br>";
                echo "Subtitulo: {$post->subtitle}";
                echo "<br>";
                echo "<br>";
                echo "Descrição: {$post->description}";
                echo "<hr>";
            }
        }
        /**
         * =============================================================================================================
         */

        /**
         * ============================================================================================================
         * THROUGH ANOTHER RELATIONSHIP
         */
        // $comments = $user->commentsOnMyPosts()->get();
        // if ($comments) {
        //     echo "<h1>Comentários nos meus posts</h1>";
        //     echo "<br>";
        //     foreach ($comments as $comment) {
        //         echo "Post: #{$comment->id} Usuário: #{$comment->user}";
        //         echo "<br>";
        //         echo "Comentário: {$comment->content}";
        //         echo "<br>";
        //         echo "<br>";
        //     }
        // }
        /**
         * =============================================================================================================
         */

        /**
         * =============================================================================================================
         * POLYMORPHIC RELATIONSHIP
         */
        $comments = $user->comments()->get();
        if ($comments) {
            echo "<h1>Comentários do post</h1>";
            echo "<br>";
            foreach ($comments as $comment) {
                echo "Comentário: #{$comment->id} {$comment->content}";
                echo "<br>";
            }
        }
        /**
         * =============================================================================================================
         */

        /**
         * =============================================================================================================
         *  SCOPES
         * To use a scope method you need to use the name declared after "scope-"
         */
        $students = User::students()->get();
        if ($students) {
            echo "<h1>Usuários estudantes</h1>";
            echo "<br>";
            foreach ($students as $student) {
                echo "Nome: {$student->name}";
                echo "<br>";
                echo "E-mail: {$student->email}";
                echo "<br>";
            }
        }

        $admins = User::admins()->get();
        if ($students) {
            echo "<h1>Usuários administradores</h1>";
            echo "<br>";
            foreach ($admins as $admin) {
                echo "Nome: {$admin->name}";
                echo "<br>";
                echo "E-mail: {$admin->email}";
                echo "<br>";
            }
        }
        /**
         * =============================================================================================================
         */

        /**
         * =============================================================================================================
         * Can be worked with serialization directly in controller, use makeVisible() or makeHidden() to decide what
         * will be available!
         */
        $users = User::all();
        var_dump($users->makeVisible('created_at')->toArray());
        var_dump($users->makeHidden('created_at')->toJson(JSON_PRETTY_PRINT));
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
