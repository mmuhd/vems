<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class remittanceItem extends Model
{
    protected $table = 'remittanceItems';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'remittances_id',
        'name',
        'amount',
    ];
}
