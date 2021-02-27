<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
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
        $post = Post::find($id);
        echo "<h1>Post do usuário</h1>";
        echo "<br>";
        echo "#{$post->id} Titulo: {$post->title}";
        echo "<br>";
        echo "<br>";
        echo "Subtitulo: {$post->subtitle}";
        echo "<br>";
        echo "<br>";
        echo "Descrição: {$post->description}";
        echo "<br>";
        echo "<br>";
        // Here are being used an accessor
        echo "Data de criação: {$post->createdFmt}";
        echo "<hr>";

        // Here are being used an mutator
        // $post->title = 'Titulo de test !';
        // $post->save();

        // In this type of relationship, madded with belongsTo(), will be returned just one data, its good to use the method first()
        $postAuthor = $post->author()->get()->first();
        if ($postAuthor) {
            echo "<h1>Dados do autors</h1>";
            echo "<br>";
            echo "Nome: {$postAuthor->name}";
            echo "<br>";
            echo "E-mail: {$postAuthor->email}";
        }
        /**
         * =============================================================================================================
         */

        /**
         * =============================================================================================================
         * MANY TO MANY RELATIONSHIP
         */
        $postCategories = $post->categories()->get();
        if ($postCategories) {
            echo "<h1>Categorias do post</h1>";
            echo "<br>";
            foreach ($postCategories as $category) {
                echo "Categoria: #{$category->id} {$category->name}";
                echo "<br>";
            }
        }
        /**
         * =============================================================================================================
         * To manage the data inside of the pivot table Laravel provides some methods
         */
        // Adds to the pivot table the data informed
        // $post->categories()->attach([3]);

        // Removes to the pivot table the data informed
        // $post->categories()->detach([3]);

        // Automates the add and remove of things inside the pivot table, will be removed all that are not informed and
        // be added what were informed
        // $post->categories()->sync([5, 10]);

        // Automates the add of things inside the pivot table, will only be added what were informed
        // $post->categories()->syncWithoutDetaching([5, 6, 7]);
        /**
         * =============================================================================================================
         */

        /**
         * =============================================================================================================
         * POLYMORPHIC RELATIONSHIP
         */
        $comments = $post->comments()->get();
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
