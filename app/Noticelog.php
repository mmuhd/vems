<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticelog extends Model
{
    protected $table = 'noticeslog';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notices_id',
        'subject',100,
        'message',5000,
        'customers_id',
        'landlords_id',
        'email',
        'cellNo',
        'status',
        'entryDate',
        'users_id',

    ];
}

