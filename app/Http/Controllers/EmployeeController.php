<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Province;
use App\Models\District;
use App\Models\Subdistrict;
use DB;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        if(isset($search))
        {
            $employees  = Employee::searchEmployee($search)->paginate(10);
        }else{
            $employees = Employee::paginate(10);
        }
        return view('employee.index', compact('employees'));
    }



    public function add()
    {
        $emptypes = Position::all();
        $provinces = Province::all();
        $districts = [];
        $subdistricts = [];

        return view('employee.add', compact('emptypes','provinces','districts','subdistricts'));
    }


    public function create(Request $request)
    {
        if(!isset($request)){
            $emptypes = Position::all();
            $provinces = Province::all();
            $districts = [];
            $subdistricts = [];
    
            return view('employee.add', compact('emptypes','provinces','districts','subdistricts'));
        }else{
            /*
            $request->validate([
                'username'=>'required',
                'password'=>'required',
                'employeeID'=>'required',
                'firstName'=> 'required',
                'lastName' => 'required'
            ]);
            */
            $this->validate($request, [
                'file' => 'image' //works for jpeg, png, bmp, gif, or svg
            ]);

            $file = $request->file('file');
            if(isset($file)){
                $file->move('uploadfile/employee',$file->getClientOriginalName());
                $imageFileName = $file->getClientOriginalName();
            }else{
                $imageFileName = "";
            }

            $employee = new Employee([
                    'username' => $request->get('username'),
                    'password'=> $request->get('password'),
                    'firstName'=> $request->get('firstName'),
                    'lastName'=> $request->get('lastName'),
            
                    'houseNo' => $request->get('houseNo'),
                    'villageNo'=> $request->get('villageNo'),
                    'road' => $request->get('road'),
                    'subdistrictID'=> $request->get('subdistrictID'),
                    'homePhone'=> $request->get('homePhone'),
                    'mobilePhone'=> $request->get('mobilePhone'),
            
                    'birthDate' => $request->get('birthDate'),
                    'gender'=> $request->get('gender'),
                    'isActive' => $request->get('isActive'),
                    'email'=> $request->get('email'),
                    'zipcode'=> $request->get('zipcode'),
            
                    'imageFileName' => $imageFileName,
                    //'departmentID'=> $request->get('departmentID'),
                    'positionID'=> $request->get('positionID')
                    
                    ]);

            $employee->save();
            return redirect('/employee')->with('success', 'employee has been added');
        }
    }

    public function view($id)
    {
        $employee = Employee::viewEmployee($id);
        
        return view('employee.view',compact('employee'));
    }

 
    public function edit($id)
    {
        $emptypes = Position::all();
        $provinces = Province::all();
        $districts = District::all();
        $subdistricts = Subdistrict::all();

        $employee = Employee::viewEmployee($id);
        return view('employee.edit', compact('employee','emptypes','provinces','districts','subdistricts'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'image' //works for jpeg, png, bmp, gif, or svg
        ]);
        
        $employee = Employee::find($id);
        $employee->firstName = $request->get('firstName');
        $employee->lastName = $request->get('lastName');
        $employee->username = $request->get('username');
        $employee->password = $request->get('password');

        $employee->houseNo = $request->get('houseNo');
        $employee->villageNo = $request->get('villageNo');
        $employee->road = $request->get('road');
        $employee->subdistrictID = $request->get('subdistrictID');
        $employee->homePhone = $request->get('homePhone');
        $employee->mobilePhone = $request->get('mobilePhone');

        $employee->birthDate = $request->get('birthDate');
        $employee->gender = $request->get('gender');
        $employee->isActive = $request->get('isActive');
        $employee->email = $request->get('email');
        $employee->zipcode = $request->get('zipcode');

        $file = $request->file('file');
        if(isset($file)){
            $file->move('uploadfile/employee',$file->getClientOriginalName());
            $employee->imageFileName = $file->getClientOriginalName();
        }

        //$employee->departmentID = $request->get('departmentID');
        $employee->positionID =  $request->get('positionID');
        $employee->save();
    
        return redirect('/employee')->with('success', 'employee has been updated');
    }


    public function delete($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
   
        return redirect('/employee')->with('success', 'Employee has been deleted Successfully');
    }

    public function district($id)
    {
        $districts = District::where('provinceID', '=', $id)->
                    orderBy('districtID', 'asc')->
                    pluck('districtName', 'districtID');
        return json_encode($districts);
    }

    public function subdistrict($id)
    {
        $subdistricts = Subdistrict::where('districtID', '=', $id)->
                    orderBy('subdistrictID', 'asc')->
                    pluck('subdistrictName', 'subdistrictID');
        return json_encode($subdistricts);
    }
}