<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $primaryKey = "orderid";
    public $timestamps = false;

    protected $fillable = ['orderdate', 'userid', 'statusid'

    ];
}
