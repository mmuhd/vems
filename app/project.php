<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class project extends Model
{
    use SoftDeletes;


    protected $dates = ['entryDate'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'projectId',
        'projectType',
        'name',
        'lat',
        'lang',
        'photo',
        'entryDate',
        'areas_id',
        'landlords_id',
        'address',
        'description',
        'storied',
        'noOfUnits',
        'noOfFloor',
        'noOfCarParking',
        'agencyFee',
        'unitSize',
        'lift',
        'generator',
        'users_id'
    ];

    public function area() {
        return $this->belongsTo('App\Area','areas_id')->withTrashed();
    }
    public function landlord() {
        return $this->belongsTo('App\Landlord','landlords_id')->withTrashed()->select(['id','name']);
    }
    public function entry() {
        return $this->belongsTo('App\User','users_id')->withTrashed();
    }
    public function flats()
    {
        return $this->hasMany('App\Flat','projects_id');
    }
    public function expenses()
    {
        return $this->hasMany('App\Expense','projects_id');
    }
    public function remittances()
    {
        return $this->hasMany('App\Remittance','agencyFee');
    }
    public function rents()
    {
        return $this->hasMany('App\Rent','projects_id');
    }
    public function repairs()
    {
        return $this->hasMany('App\Repairs','projects_id');
    }
    function setEntryDateAttribute($value)
    {
        $this->attributes['entryDate'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
}
