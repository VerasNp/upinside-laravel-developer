<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    /**
     * Informs that will be used soft delete methods
     */
    use SoftDeletes;

    /**
     * Set the table that this model will work with
     */
    protected $table = "posts";

    /**
     * Set the primary key that this model will work with
     */
    protected $primaryKey = "id";

    /**
     * Set the usage of timestamps columns (created_at or updated_at)
     */
    public $timestamps = true;

    /**
     * Set the default name of timestamps columns (created_at or updated_at)
     * Attention: you need to inform the name of each new column!
     */
    //public const UPDATED_AT = "last_update";
    //public const CREATED_AT = "creation_date";

    /**
     * Set the properties that will be possible to be informed and edited
     */
    protected $fillable = ['title', 'subtitle', 'description'];

    /**
     * Set the properties that will NOT be possible to be informed and edited
     */
    // protected $guard = [];
}
