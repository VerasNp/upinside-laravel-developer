<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content'];

    /**
     * Polymorphic relationship: an comment can has many types, can be an ticket, an message, and others
     */
    public function item()
    {
        /**
         * Method morphTo(): Defines an polymorphic
         */
        return $this->morphTo();
    }
}
