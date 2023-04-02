@extends('layouts.admin')

@section('content')


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.province.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">แก้ไขรายละเอียดจังหวัด</li>
  </ol>
</nav>


<div class="card">
  <div class="card-header">
    <h2>แก้ไขข้อมูลจังหวัด</h2>
  </div>
  <div class="card-body">
      <!-- /province/<?=request()->segment(count(request()->segments())-1)?> -->      
      <form method="post" action="{{ route('admin.province.update', $province->provinceID) }}">
        @csrf
          <div class="mb-3 mt-3">
            <label for="provinceID" class="form-label">รหัสจังหวัด:</label>
            <input type="text" class="form-control @error('provinceID') is-invalid @enderror" 
              id="provinceID"  name="provinceID"  value="{{old('provinceID')}}" placeholder="กรุณาระบุรหัสจังหวัด" >
            <div id="invalid-provinceID" class="invalid-feedback">{{ $errors->first('provinceID') }}</div>
          </div>

          <div class="mb-3 mt-3">
            <label for="provinceName" class="form-label">ชื่อจังหวัด:</label>
            <input type="text" class="form-control @error('provinceName') is-invalid @enderror" id="provinceName"  name="provinceName" value="{{$province->provinceName}}" placeholder="กรุณาระบุชื่อจังหวัด" >
            <div id="invalid-provinceName" class="invalid-feedback">{{ $errors->first('provinceName') }}</div>
          </div>

          <button type="submit" id="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
  
        </form>
  </div>
</div>
          
@endsection