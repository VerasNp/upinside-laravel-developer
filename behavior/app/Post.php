<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'subtitle', 'description', 'author', 'slug'];

    public const RELATIONSHIP_POST_CATEGORY = 'post_category';

    /**
     * One to one relationship: The post table relates with one user data (the author of this post)
     */
    public function author()
    {
        /**
         * Method belongsTo(): informs that the post belongs to one user data
         * Need to inform to what model is related, the foreign key that exists inside Post table that
         * relates to the informed model and
         * to which primary key this foreign key relates
         */
        return $this->belongsTo(User::class, 'author', 'id');
    }

    /**
     * Many(n) to many(n) relationship: One post can be related to one category, at the same time, one
     * post can be related to many categories and many posts can be related to one and many categories
     */
    public function categories()
    {
        /**
         * Method belongsToMany(): informs that an post can belongs to many categories.
         * To this process is necessary to use an pivot table. This table will be responsible to stores
         * posts and categories ids that relates to each other.
         * Need to inform what model is related, the name of the pivot table (prefer to use an const!),
         * the name of the foreign key existent inside the pivot key that refers to this model, the
         * foreign key that of the model that this model are relating with
         */
        return $this->belongsToMany(Category::class, self::RELATIONSHIP_POST_CATEGORY, 'post', 'category');
    }

    /**
     * Polymorphic relationship: an comment can has many types, can be an ticket, an message, and others
     */
    public function comments()
    {
        /**
         * Method morphMany(): Allows to inside the model works with the two columns generated (item_type and item_id)
         */
        return $this->morphMany(Comment::class, 'item');
    }

    /**
     * Its possible to transform the return of an attribute with accessors when its accessed
     * To create an accessor is necessary to use an function signature:
     * function get*Attribute()
     * {
     *     return ...
     * }
     * That below will return the attribute created_at formatted to 'd/m/Y H:i'
     */
    public function getCreatedFmtAttribute()
    {
        return date('d/m/Y H:i', strtotime($this->created_at));
    }

    /**
     * Its possible to transform the return of an attribute with accessors when its set
     * To create an mutator is necessary to use an function signature:
     * function set*Attribute()
     * {
     *     // logic
     * }
     * That bellow transform the value of title into an slug
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
}
