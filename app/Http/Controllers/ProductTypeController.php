<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Requests\ProductTypeRequest;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producttypes = ProductType::all();        
        return view("admin.producttype.index", compact("producttypes"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.producttype.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductTypeRequest $request)
    {        
        $producttypeName = $request->get("producttypeName");        

        $producttype = new ProductType();        
        $producttype->producttypeName = $producttypeName;      
        $producttype->save();

        return redirect("/admin/producttype")->with("success","คุณได้ทำการลงทะเบียนเรียบร้อยแล้ว");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductType  $producttype
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producttype = ProductType::find($id);
        return view("admin.producttype.show", compact("producttype"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductType  $producttype
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producttype = ProductType::find($id);

        return view("admin.producttype.edit", compact("producttype"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductType  $producttype
     * @return \Illuminate\Http\Response
     */
    public function update(ProductTypeRequest $request, $id)
    {              
        $producttypeName = $request->get("producttypeName");

        $producttype = ProductType::find($id);        
        $producttype->producttypeName = $producttypeName;                 
        $producttype->save();
        
        return redirect("/admin/producttype")->with("success","คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductType  $producttype
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $producttype = ProductType::find($id);
        $producttype->delete();        
        return redirect("/admin/producttype")->with("delete","คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว");
    }
}
