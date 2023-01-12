<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Employee extends Model
{
    //protected $primaryKey = null;
    //protected $primaryKey = ['user_id', 'stock_id']
    protected $table = 'employee'; // Ignore automatically add "s" into table name
    public $incrementing = true; // Ignore incremental primary key
    public $timestamps = false; // Ignore automatically add create_at and update_at attribute into table
    protected $primaryKey = 'employeeID'; //Ignore automatically query with id as primary key


    protected $fillable = [
        'userID', 'firstName', 'lastName', 'houseNo', 'villageNo', 'road', 'subdistrictID','homePhone', 'mobilePhone', 'birthDate', 'gender', 'isActive', 'username', 'password', 'email', 'zipcode', 'imageFileName','departmentID', 'positionID'
    ];

    public static function index()
    {
        $sql="SELECT * FROM employee 
            INNER JOIN position ON employee.positionID=position.positionID 
            INNER JOIN subdistrict ON employee.subdistrictID=subdistrict.subdistrictID 
            INNER JOIN district ON subdistrict.districtID=district.districtID 
            INNER JOIN province ON district.provinceID=province.provinceID 
            ORDER BY employee.employeeID ASC ";
        return DB::select($sql);
    }

    public static function view($id)
    {
        $sql="SELECT * FROM employee 
         INNER JOIN position ON employee.positionID=position.positionID 
         INNER JOIN subdistrict ON employee.subdistrictID=subdistrict.subdistrictID 
         INNER JOIN district ON subdistrict.districtID=district.districtID 
         INNER JOIN province ON district.provinceID=province.provinceID 
         WHERE employee.employeeID=$id";
         $data=DB::select($sql);
         if(count($data)>0)$data=$data[0];
         return $data;
    }

    public static function searchEmployee($q)
    {
        return DB::table('employee')
                ->join('position', 'employee.positionID', '=', 'position.positionID')
                ->join('subdistrict', 'employee.subdistrictID', '=', 'subdistrict.subdistrictID')
                ->join('district', 'subdistrict.districtID', '=', 'district.districtID')
                ->join('province', 'district.provinceID', '=', 'province.provinceID')
                ->select('*')
                ->where('firstName', 'LIKE', '%' . $q . '%')
                ->orWhere('lastName', 'LIKE', '%' . $q . '%')
                ->orWhere('positionName', 'LIKE', '%' . $q . '%')
                ->orWhere('provinceName', 'LIKE', '%' . $q . '%')
                ->orWhere('districtName', 'LIKE', '%' . $q . '%')
                ->orWhere('subdistrictName', 'LIKE', '%' . $q . '%');
    }
    
    public static function validateUser($username,$password)
    {
        return DB::table('employee')
                ->select('*')
                ->where('username', $username)
                ->Where('password', $password)
                ->first();
    }

}
