<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use yhfagge\Userstamps\UserstampsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppMeta extends Model
{
    use SoftDeletes;
    use UserstampsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['meta_key','meta_value'];
}
