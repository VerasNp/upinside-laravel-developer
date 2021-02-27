<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['address', 'number', 'complement', 'zipcode', 'city', 'state'];

    /**
     * One to one relationship: The address table relates with one user data
     */
    public function user()
    {
        /**
         * Method belongsTo(): informs that the address belongs to one user data
         * Need to inform to what model is related, the foreign key that exists inside Address table that relates to the informed model and
         * to which primary key this foreign key relates
         */
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
