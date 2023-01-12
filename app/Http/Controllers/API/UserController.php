<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{    

    public function update(Request $request)
    {
        $userid = $request->get('userid');
        $username = $request->get('username');
        $password = $request->get('password');
        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
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
        firstname='$firstname', lastname='$lastname', address='$address', ";        
        $sql .= $sql_image." ".$sql_pass;
        $sql .= "mobilephone='$mobilephone' WHERE userid='$userid' ";
        //echo $sql;
        //die();

        DB::update($sql);


        return response()->json(
                array('message'=>'update a user successfully',
                'status'=>'true'));        

    }

    public function profile($id)
    {
        $sql="SELECT * FROM users 
            WHERE userid=$id";
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


    public function register(Request $request){
        $username = $request->get('username');
        $password = $request->get('password');
        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');

        $sql = "INSERT INTO users (username,password,firstname,lastname) 
                VALUES ('$username','$password','$firstname','$lastname')";
        DB::insert($sql);

        return response()->json(
                array('message'=>'add a user successfully',
                'status'=>'true'));

    }


    public function login(Request $request){
        $username = $request->get('username');
        $password = $request->get('password');

        $sql = "SELECT * FROM users WHERE (username='$username' OR email='$username') AND 
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
}