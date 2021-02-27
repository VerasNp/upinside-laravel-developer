<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    /**
     * Many(n) to many(n) relationship: One category can be related to one post, at the same time, one
     * category can be related to many posts and many categories can be related to one and many posts
     */
    public function posts()
    {
        /**
         * Method belongsToMany(): informs that an category can belongs to many posts.
         * To this process is necessary to use an pivot table. This table will be responsible to stores
         * posts and categories ids that relates to each other.
         * Need to inform what model is related, the name of the pivot table (prefer to use an const!),
         * the name of the foreign key existent inside the pivot key that refers to this model, the
         * foreign key that of the model that this model are relating with
         */
        return $this->belongsToMany(Post::class, Post::RELATIONSHIP_POST_CATEGORY, 'category', 'post');
    }
}
