<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HousepriceController extends Controller
{
    public function test(){
        return view('houseprice.test');        
    }

    public function predict(Request $request){
        $path = "C:\\xampp\\htdocs\\shopdee\\app\\python\\test_mlp.py";
        $year = $request->get('year');
        $age = $request->get('age');
        $distance = $request->get('distance_to_sky_train');
        $minimart = $request->get('number_of_near_minimarts');
        ob_start();
        passthru("python $path $year $age $distance $minimart");
        $output = preg_replace('~[\r\n]+~','', ob_get_clean());     
        echo "<script>alert('$output')</script>";        
    }

    public function train(){
        return view('houseprice.train');
    }

    public function build(){
        $path = "C:\\xampp\\htdocs\\shopdee\\app\\python\\train_mlp.py";

        ob_start();
        passthru("python $path");
        $output = preg_replace('~[\r\n]+~','', ob_get_clean());     

        echo "<script>alert('$output')</script>";

    }

}