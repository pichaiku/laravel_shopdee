<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //protected $primaryKey = null;
    //protected $primaryKey = ['user_id', 'stock_id']
    protected $table = 'position'; // Ignore automatically add "s" into table name
    public $incrementing = false; // Ignore incremental primary key
    public $timestamps = false; // Ignore automatically add create_at and update_at attribute into table
    protected $primaryKey = 'positionID'; //Ignore automatically query with id as primary key


    protected $fillable = [
        'positionID', 'positionName',
    ];

}
