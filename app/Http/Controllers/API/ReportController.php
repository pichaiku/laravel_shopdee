<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use DB;

class ReportController extends Controller
{
    //ยอดการสั่งซื้อรายเดือน (บาท)    
    public function monthlySale($id)    
    {
        $year=date("Y");        
        $sql = "SELECT SUBSTRING(`orders`.orderdate,6,2) AS month, 
                    SUM(orderdetail.quantity*orderdetail.price) AS totalAmount 
                FROM product 
                    INNER JOIN orderdetail ON product.productid=orderdetail.productid
                    INNER JOIN `orders` ON orderdetail.orderid=`orders`.orderid ";
                
                if($id!="" && $year!=""){
                $sql .="WHERE `orders`.`userid`=$id AND SUBSTRING(`orders`.orderdate,1,4)='$year' ";
                }else if($id!=""){
                $sql .="WHERE `orders`.`userid`=$id ";
                }else if($year!=""){
                $sql .="WHERE SUBSTRING(`orders`.orderdate,1,4)='$year' ";
                }

                $sql .=" GROUP BY SUBSTRING(`orders`.orderdate,6,2)
                ORDER BY SUBSTRING(`orders`.orderdate,6,2) ASC";        
        return response()->json( DB::select($sql) );
    }

    //สินค้าที่มียอดการสั่งซื้อ 5 อันดับแรก (บาท)
    public function topFiveProduct($id)
    {
        $year=date("Y");
        $sql = "SELECT product.productid, productname, 
                        SUM(orderdetail.quantity*orderdetail.price) AS totalAmount 
                FROM product 
                    INNER JOIN orderdetail ON product.productid=orderdetail.productid
                    INNER JOIN `orders` ON orderdetail.orderid=`orders`.orderid ";

                if($id!="" && $year!=""){
                $sql .="WHERE `orders`.`userid`=$id AND SUBSTRING(`orders`.orderdate,1,4)='$year' ";
                }else if($id!=""){
                $sql .="WHERE `orders`.`userid`=$id ";
                }else if($year!=""){
                $sql .="WHERE SUBSTRING(`orders`.orderdate,1,4)='$year' ";
                }    

                $sql .="GROUP BY product.productid, productname 
                ORDER BY SUM(orderdetail.quantity*orderdetail.price) DESC LIMIT 5";
        return response()->json( DB::select($sql) );
    }
 
}