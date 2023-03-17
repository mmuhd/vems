<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class remittance extends Model
{
    use SoftDeletes;

    protected $dates = ['entryDate'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'projects_id',
        'landlords_id',
        'areas_id',
        'remittanceNo',50,
        'amount',
        'note',
        'entryDate',
        'users_id',
    ];

    public function project() {
        return $this->belongsTo('App\project','projects_id')->withTrashed()->select(['id','name']);
        return $this->hasMany('App\project','agencyFee');
    }
    public function area() {
        return $this->belongsTo('App\Area','areas_id')->withTrashed();
    }
    public function landlord() {
        return $this->belongsTo('App\Landlord','landlords_id')->withTrashed()->select(['id','name']);
    }
    public function item() {
        return $this->hasMany('App\RemittanceItem','Remittances_id');
    }
    public function entry() {
        return $this->belongsTo('App\User','users_id')->withTrashed()->select(['id','name']);
    }

    function setEntryDateAttribute($value)
    {
        $this->attributes['entryDate'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
}
