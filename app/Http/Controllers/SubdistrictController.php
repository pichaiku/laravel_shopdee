<?php

namespace App\Http\Controllers;

use App\Models\Subdistrict;
use Illuminate\Http\Request;
use App\Http\Requests\SubdistrictRequest;

class SubdistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subdistricts = Subdistrict::all();        
        return view("admin.subdistrict.index", compact("subdistricts"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.subdistrict.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubdistrictRequest $request)
    {
        $subdistrictID = $request->get("subdistrictID");
        $subdistrictName = $request->get("subdistrictName");        
        $districtID = $request->get("districtID");      

        $subdistrict = new Subdistrict();
        $subdistrict->subdistrictID = $subdistrictID;
        $subdistrict->subdistrictName = $subdistrictName;      
        $subdistrict->districtID = $districtID;   
        $subdistrict->save();

        return redirect("/admin/district")->with("success","คุณได้ทำการลงทะเบียนเรียบร้อยแล้ว");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subdistrict  $district
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subdistrict = Subdistrict::find($id);
        return view("admin.subdistrict.show", compact("subdistrict"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subdistrict  $district
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subdistrict = Subdistrict::find($id);

        return view("admin.subdistrict.edit", compact("subdistrict"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subdistrict  $district
     * @return \Illuminate\Http\Response
     */
    public function update(SubdistrictRequest $request, $id)
    {   
        $subdistrictID = $request->get("subdistrictID");     
        $subdistrictName = $request->get("subdistrictName");
        $districtID = $request->get("districtID");      

        $subdistrict = Subdistrict::find($id);
        $subdistrict->subdistrictID = $subdistrictID;
        $subdistrict->subdistrictName = $subdistrictName;                 
        $subdistrict->districtID = $districtID; 
        $subdistrict->save();
        
        return redirect("/admin/district")->with("success","คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subdistrict  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $subdistrict = Subdistrict::find($id);
        $subdistrict->delete();        
        return redirect("/admin/district")->with("delete","คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว");
    }
}
