@extends('layouts.admin')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">แก้ไขรายละเอียดลูกค้า</li>
  </ol>
</nav>

    <!-- @if($errors->any())
    <div class="alert alert-danger mb-3">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif -->

    <h2>แก้ไขข้อมูลลูกค้า</h2>
    <div class="card">
      <!-- /customer/<?=request()->segment(count(request()->segments())-1)?> -->
      
      <form method="post" class="card-body" action="{{ route('admin.customer.update', $customer->custID) }}">
      @csrf
        <div class="mb-3">
          <label for="username" class="form-label">ชื่อผู้ใช้:</label>
          <input type="" class="form-control" id="username"  name="username" value="{{$customer->username}}" placeholder="กรุณาระบุชื่อผู้ใช้" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">รหัสผ่าน:</label>
          <input type="password" class="form-control" id="password" name="password" value="{{$customer->password}}" placeholder="กรุณาระบุรหัสผ่าน" required>
        </div>

        <div class="mb-3 mt-3">
          <label for="firstName" class="form-label">ชื่อ:</label>
          <input type="text" class="form-control" id="firstName"  name="firstName" value="{{$customer->firstName}}" placeholder="กรุณาระบุชื่อ" required>
        </div>

        <div class="mb-3">
          <label for="lastName" class="form-label">นามสกุล:</label>
          <input type="text" class="form-control" id="lastName" name="lastName" value="{{$customer->lastName}}" placeholder="กรุณาระบุนามสกุล" required>
        </div>

        <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>

      </form>
    </div>
@endsection