<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be visible for arrays.
     *
     * @var array
     */
    protected $visible = [
        'name', 'email', 'admin'
    ];

    /**
     * Calls an accessor
     */
    protected $appends = [
        'admin'
    ];

    /**
     * ATTENTION: Respect the plural and the singular!
     */

    /**
     * One to one relationship: The user table relates with just one address data
     */
    public function addressDelivery()
    {
        /**
         * Method hasOne(): Informs that the user has one address data related with it
         */
        return $this->hasOne(Address::class, 'user', 'id');
        // return $this->hasOne('App\Address');
    }

    /**
     * One to many(n): The user table relates with many posts
     */
    public function posts()
    {
        /**
         * Method hasMany(): Informs that the user has many posts related with it
         */
        return $this->hasMany(Post::class, 'author', 'id');
    }

    /**
     * Through another relationship: The user has one post related to it, but inside the post it has comments that are
     * related to this post, so these comments are related to the user
     */
    public function commentsOnMyPosts()
    {
        /**
         * Method hasManyThrough(): Informs that an relation of user and comments need to pass through the post table
         * Need to inform the final table that its wanted, the table that will be used to pass through, an foreign key
         * that relates the user table to the table that will be used to pass through, another foreign key that relates
         * the final table to the table that will be used to pass through, the primary key that the first foreign key
         * informed are referencing and another primary key that the second foreign key are referencing
         */
        return $this->hasManyThrough(Comment::class, Post::class, 'author', 'post', 'id', 'id');
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
     * Scopes: its possible to define an scope of data that will be returned
     * To define an scope its necessary to follow an function signature:
     * function scope*($query)
     * {
     *     return $query->where();
     * }
     * The function's name need to has this style!
     * This ones below return the users that has the level less or equal to 5
     */
    public function scopeStudents($query)
    {
        return $query->where('level', '<=', 5);
    }

    /**
     * This another returns the users the users that has level higher than 5
     */
    public function scopeAdmins($query)
    {
        return $query->where('level', '>', 5);
    }

    /**
     * Its possible to transform the return of an attribute with accessors when its accessed
     * To create an accessor is necessary to use an function signature:
     * function get*Attribute()
     * {
     *     return ...
     * }
     * That below will return true or false
     */
    public function getAdminAttribute()
    {
        return ($this->attributes['level'] > 5 ? true : false);
    }
}
