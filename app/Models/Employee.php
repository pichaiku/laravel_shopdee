<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'empID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'firstName',
                  'lastName',
                  'address',
                  'subdistrictID',
                  'zipcode',
                  'mobilePhone',
                  'homePhone',
                  'birthdate',
                  'gender',
                  'email',
                  'username',
                  'password',
                  'imageFile',
                  'positionID',
                  'isActive'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    

    /**
     * Set the birthdate.
     *
     * @param  string  $value
     * @return void
     */
    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = !empty($value) ? \DateTime::createFromFormat('j/n/Y g:i A', $value) : null;
    }

    /**
     * Get birthdate in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getBirthdateAttribute($value)
    {
        //return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
        return $value;
    }

}
