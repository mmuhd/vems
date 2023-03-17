<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Repairs extends Model
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
        'flats_id',
        'landlords_id',
        'phoneNo',
        'photo',
        'format',
        'repairsNo',50,
        'subject',
        'message',
        'active',
        'entryDate',
        'users_id',
        'noticeType',

    ];
    public function project() {
        return $this->belongsTo('App\project','projects_id')->withTrashed()->select(['id','name']);
    }
    public function flat() {
        return $this->belongsTo('App\Flat','flats_id')->withTrashed()->select(['id','description']);
    }
    public function customer() {
        return $this->belongsTo('App\Customer','customers_id')->withTrashed()->select(['id','name','cellNo','permanentAddress','photo']);
    }
    public function entry() {
        return $this->belongsTo('App\User','users_id')->withTrashed()->select(['id','name']);
    }

    public function rents()
    {
        return $this->hasMany('App\Rent','notices_id');
    }
    public function collections()
    {
        return $this->hasMany('App\RentCollection','notices_id');
    }

  public function renews()
    {
        return $this->hasMany('App\Renew','notices_id');
    }  
    public function remittances()
    {
        return $this->hasMany('App\Remittance','notices_id');
    }
    public function landlord() {
        return $this->belongsTo('App\Landlord','landlords_id')->withTrashed()->select(['id','name','cellNo', 'companyName', 'cCellNo', 'email', 'cEmail', 'permanentAddress','photo']);
            }
    function setEntryDateAttribute($value)
    {
        $this->attributes['entryDate'] = Carbon::createFromFormat('d/m/Y', trim($value));
    }

}
