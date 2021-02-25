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
        /**
         * Query builder
         * 1º will return an collection of eloquent
         * 2º will return one object of model
         * 3º will return one object of model, if not find nothing will return an 404 page
         * 4º will return one object of model based on the primary_key informed
         * 5º will return one object of model based on the primary_key informed, if not find nothing * will return an 404 page
         * 6º will return boolean based on the search of an collection
         * 7º will return the number of incident data based on the returned collection
         * 8º will return the biggest data based on the returned collection, and the columns specified
         * Attention: Can be used sum, count, min, max, avg
         * 9º Return all data in a collection with trashed data
         * 10º Return all data in a collection without trashed data
         */

        // $posts = Post::where('created_at', '<=', date('Y-m-d H:i:s'))->orderBy('title', 'DESC')->take(2)->get();
        // foreach ($posts as $post) {
        //     echo "<h1>{$post->title}</h1>";
        //     echo "<h2>{$post->subtitle}</h2>";
        //     echo "<h3>{$post->description}</h3>";
        //     echo "<hr>";
        // }

        // $post = Post::where('created_at', '<=', date('Y-m-d H:i:s'))->first();
        // echo "<h1>{$post->title}</h1>";
        // echo "<h2>{$post->subtitle}</h2>";
        // echo "<h3>{$post->description}</h3>";
        // echo "<hr>";

        // $post = Post::where('created_at', '<=', date('Y-m-d H:i:s'))->firstOrFail();

        // $post = Post::find(1);

        // $post = Post::findOrFail(1000);

        // $posts = Post::where('created_at', '<=', date('Y-m-d H:i:s'))->exists();

        // $posts = Post::where('created_at', '<=', date('Y-m-d H:i:s'))->count();

        // $posts = Post::where('created_at', '<=', date('Y-m-d H:i:s'))->max('title');

        // $posts = Post::withTrashed()->get();

        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * 1º method: Object -> Prop -> Save
         * First created the object, than configure the properties and finally saves
         */
        $post = new Post();
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->description = $request->description;
        $post->save();

        /**
         * 2º method: create() with mass assignment
         * Attention: to work with mass assignment its necessary to config fillable or guard
         * properties on the model
         */
        // Post::create([
        //     'title' => $request->title,
        //     'subtitle' => $request->subtitle,
        //     'description' => $request->description,
        // ]);

        /**
         * 3º method: firstOrNew() with mass assignment
         * Works like an where(), it tries to find an data with the same informed value, if finds it
         * will be not be created and its returned the find data, if not it is created an new data
         */
        // $post = Post::firstOrNew(
        //     [
        //         'title' => $request->title
        //     ],
        //     [
        //         'subtitle' => $request->subtitle
        //     ],
        //     [
        //         'description' => $request->description
        //     ]
        // );
        // $post->save();

        /**
         *  4º method: firstOrCreate() with mass assignment
         * Works like an where(), it tries to find an data with the same informed value, if finds it
         * will be not be created and its returned the find data, if not it is created an new data
         * Attention: The difference between firstOrCreate() and firstOrNew() its the usage of the
         * method save()
         */
        // $post = Post::firstOrCreate(
        //     [
        //         'title' => $request->title
        //     ],
        //     [
        //         'subtitle' => $request->subtitle
        //     ],
        //     [
        //         'description' => $request->description
        //     ]
        // );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        /**
         * 1º method: Prop -> Save
         */
        // $post->title = $request->title;
        // $post->subtitle = $request->subtitle;
        // $post->description = $request->description;
        // $post->save();

        /**
         * 2º method: Find -> Prop -> Save
         */
        // $post = Post::find($post->id);
        // $post->title = $request->title;
        // $post->subtitle = $request->subtitle;
        // $post->description = $request->description;
        // $post->save();

        /**
         * 3º method: updateOrCreate()
         */
        // $post = Post::updateOrCreate([
        //     'title' => $request->title
        // ], [
        //     'subtitle' => $request->subtitle
        // ], [
        //     'description' => $request->description
        // ]);

        /**
         * 4º method: mass update
         * Attention: Will be returned an collection and all the fields informed inside update()
         * method will be updated to the same data!
         */
        // Post::where('created_at', '<=', date('Y-m-d H:i:s'))->update(['description' => $request->description]);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        /**
         * 1º method: Find -> Delete
         */
        Post::find($post->id)->delete();

        /**
         * 2º method: Mass delete
         */
        // Post::destroy([2, 3]);
        // or
        // Post::where('created_at', '<=', date('Y-m-d H:i:s'))->delete();

        /**
         * 3º method: destroy()
         */
        // Post::destroy($post->id);

        return redirect()->route('posts.index');
    }

    public function trashed()
    {
        /**
         * Returns only data that are marked as deleted (with something on the deleted_at column)
         */
        $posts = Post::onlyTrashed()->get();

        return view('posts.trashed', ['posts' => $posts]);
    }

    public function restore($post)
    {
        /**
         * Restores the data that are marked as deleted
         */
        $post = Post::onlyTrashed()->where(['id' => $post])->first();
        if ($post->trashed()) {
            $post->restore();
        }

        return redirect()->route('posts.index');
    }

    public function forceDelete($post)
    {
        /**
         * Delete definitively the data
         */
        Post::onlyTrashed()->where(['id' => $post])->forceDelete();

        return redirect()->route('posts.index');
    }
}
