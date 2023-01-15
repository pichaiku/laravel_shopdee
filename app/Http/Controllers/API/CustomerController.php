<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{   


    public function register(Request $request){
        $username = $request->get('username');
        $password = $request->get('password');
        $firstName = $request->get('firstName');
        $lastName = $request->get('lastName');

        $sql = "INSERT INTO customer (username, password, firstName, lastName)
                VALUES ('$username', '$password', '$firstName', '$lastName')";

        DB::insert($sql);

        return response()->json(
                array('message'=>'ลงทะเบียนสำเร็จแล้ว',
                    'status'=>'true'));

    }

    public function login(Request $request){
        $username = $request->get('username');
        $password = $request->get('password');

        $sql = "SELECT * FROM customer WHERE username='$username' AND 
                password = '$password' ";
        $users=DB::select($sql);

        if($users){
            $user = (array)$users[0];
            $user['message'] = 'success';
            $user['status'] = 'true';
        }else{
            $user = array();
            $user['message'] = 'this user is not found.';
            $user['status'] = 'false';          
            // $user = array('message' => 'this user is not found.',
            //         'status'=>'false');
        }
        return response()->json($user);
        
    }

    public function delete($id){
        $sql = "DELETE FROM customer 
                WHERE custID=$id";
        DB::delete($sql);

        return response()->json(
                array('message'=>'ลบข้อมูลเรียบร้อยแล้ว',
                    'status'=>'true'));        
    }

    public function profile($id)
    {
        $sql="SELECT * FROM customer  
            WHERE custID=$id";
        $user=DB::select($sql);         

        if($user){
            $user = (array)$user[0];
            $user['message'] = 'success';
            $user['status'] = 'true';          
        }else{
            $user = array(
                'message' => 'this user is not found', 
                'status' => 'false');
        }
        
        return response()->json($user);
    }


    public function update(Request $request)
    {
        $userid = $request->get('userid');
        $username = $request->get('username');
        $password = $request->get('password');
        $firstName = $request->get('firstName');
        $lastName = $request->get('lastName');
        $email = $request->get('email');
        $address = $request->get('address');
        $mobilephone = $request->get('mobilephone');
        
        $file = $request->file("imagefile");
        if(isset($file)){
            $file->move("assets/user", $file->getClientOriginalName());
            $imagefile = $file->getClientOriginalName();
            $sql_image = "imagefile='$imagefile',";
        }else{            
            $sql_image = "";
        }

        if($password != ""){
            $sql_pass = "password='$password',";
        }else{
            $sql_pass = "";
        }

        $sql = "UPDATE users set username='$username', 
        firstName='$firstName', lastName='$lastName', address='$address', ";        
        $sql .= $sql_image." ".$sql_pass;
        $sql .= "mobilephone='$mobilephone' WHERE userid='$userid' ";
        //echo $sql;
        //die();

        DB::update($sql);


        return response()->json(
                array('message'=>'update a user successfully',
                'status'=>'true'));        

    }    

}