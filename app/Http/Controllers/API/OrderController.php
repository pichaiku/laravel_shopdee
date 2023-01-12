<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;

class OrderController extends Controller
{    

    public function view(Request $request){

    }
    public function create(Request $request){

    }    

    public function update(Request $request){

    }    

    

    public function orderlist($id){        
        $sql = "SELECT `orders`.`orderid`, `orderdate`, `shipdate`, 
        `receivedate`, `orders`.`userid`, `statusid`,
        users.firstname,users.lastname,
        SUM(orderdetail.quantity) AS totalQuantity,
        SUM(orderdetail.quantity*orderdetail.price) AS totalPrice 
        FROM `orders` 
            INNER JOIN users ON users.userid=`orders`.userid         
            INNER JOIN orderdetail ON `orders`.`orderid`=orderdetail.orderid 
        WHERE orders.userid=$id 
        GROUP BY `orders`.`orderid`, `orderdate`, `shipdate`, 
            `receivedate`, `orders`.`userid`, `statusid`,
            users.firstname,users.lastname     
        ORDER BY `orders`.orderid ASC ";
          
        return DB::select($sql);        
    }
    public function orderinfo($id){        
        $sql = "SELECT `orders`.`orderid`, `orderdate`, `shipdate`, 
        `receivedate`, `orders`.`userid`, `statusid`,
        users.firstname,users.lastname,users.address,users.mobilePhone,
        SUM(orderdetail.quantity) AS totalQuantity,
        SUM(orderdetail.quantity*orderdetail.price) AS totalPrice 
        FROM `orders` 
            INNER JOIN users ON users.userid=`orders`.userid         
            INNER JOIN orderdetail ON `orders`.`orderid`=orderdetail.orderid 
        WHERE orders.orderid=$id 
        GROUP BY `orders`.`orderid`, `orderdate`, `shipdate`, 
            `receivedate`, `orders`.`userid`, `statusid`,
            users.firstname,users.lastname,users.address,users.mobilePhone      
        ORDER BY `orders`.orderid ASC ";
          
        return DB::select($sql);        
    }
    public function itemcount($id)
    {
        $sql = "SELECT a.orderid,COUNT(*) as itemcount
                FROM orders as a
                    INNER JOIN orderdetail as b ON a.orderid=b.orderid
                WHERE a.userid=$id  AND a.statusid=0
                GROUP BY a.orderid";
        return DB::select($sql);
    }

    //function confirm order
    public function confirmorder(Request $request){
        $orderdate = date("Y-m-d H:i:s");
        $sql = "UPDATE orders 
                SET orderdate = '$orderdate', statusid = 1 
                WHERE orderid = ".$request->get("orderid");
        DB::update($sql);

        return response()->json(
            array('message' => 'success','status' => 'true')
        );        
    }

    public function order(Request $request)
    {


        $userid = $request->get("userid");
        $productid = $request->get("productid");
        $quantity = $request->get("quantity");
        $price = $request->get("price");

        //check existing order
        $sql="SELECT orderid FROM orders WHERE userid=$userid AND statusid=0";
        $order=DB::select($sql);

        if(count($order)==0)//no-existing order
        {
            $order = new Order();
            $order->userid = $userid;
            $order->statusid = 0;
            $order->save();
            
            $sql = "INSERT INTO orderdetail VALUeS($order->orderid, $productid,$quantity,$price)";
            DB::insert($sql);

        }else{//existing order

            $orderid = $order[0]->orderid;
            $sql="SELECT COUNT(*) AS orderdetailcount 
                  FROM orderdetail 
                  WHERE orderid = $orderid AND productid = $productid";
            $orderdetail = DB::select($sql);

            if($orderdetail[0]->orderdetailcount == 0)//no-existing order detail
            {
                $sql = "INSERT INTO orderdetail VALUeS($orderid, $productid,$quantity,$price)";
                DB::insert($sql);

            }else{
                $sql = "UPDATE orderdetail 
                        SET quantity = quantity + $quantity 
                        WHERE orderid = $orderid AND productid = $productid";
                DB::update($sql);

            }
            
        }

        return response()->json(
            array('message' => 'success','status' => 'true')
        );

    }


  

}