<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{   
    public function login(Request $request){
        $username = $request->get('username');
        $password = $request->get('password');

        $sql = "SELECT * FROM customer WHERE (username='$username' OR email='$username') AND 
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