<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();        
        return view("admin.product.index", compact("products"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.product.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $productName = $request->get("productName");
        $productDetail = $request->get("productDetail");
        $price = $request->get("price");
        $quantity = $request->get("quantity");

        $imageFile = $request->get("imageFile");        
        $imageFile->move("assets/product", $imageFile->getClientOriginalName());
        $imageFile = $imageFile->getClientOriginalName();     

        $typeID  = $request->get("typeID ");

        $product = new Product();
        $product->productName = $productName;
        $product->productDetail = $productDetail;
        $product->price = $price;
        $product->quantity = $quantity;
        $product->imageFile = $imageFile;
        $product->typeID = $typeID;        
        $product->save();

        return redirect("/admin/product")->with("success","คุณได้ทำการลงทะเบียนเรียบร้อยแล้ว");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view("admin.product.show", compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        // if(isset($file)){
        //     $imageFile = $request->get("imageFile");        
        //     $imageFile->move("assets/product", $imageFile->getClientOriginalName());
        //     $imageFile = $imageFile->getClientOriginalName();   
        // }

        return view("admin.product.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {        
        $productName = $request->get("productName");
        $productDetail = $request->get("productDetail");
        $price = $request->get("price");
        $quantity = $request->get("quantity");
        $imageFile = $request->get("imageFile");
        $typeID  = $request->get("typeID ");

        $product = Product::find($id);
        $product->productName = $productName;
        $product->productDetail = $productDetail;
        $product->price = $price;
        $product->quantity = $quantity;
        $product->imageFile = $imageFile;
        $product->typeID = $typeID;           
        $product->save();
        
        return redirect("/admin/product")->with("success","คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $product = Product::find($id);
        $product->delete();        
        return redirect("/admin/product")->with("delete","คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว");
    }
}
