@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">รายละเอียดลูกค้า</li>
  </ol>
</nav>
    <h2>รายละเอียดลูกค้า</h2>
    <div class="card">
      <div class="card-body">
      
        <div class="mb-3">
          <label for="username" class="form-label">ชื่อผู้ใช้:</label>
          {{$customer->username}}
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">รหัสผ่าน:</label>
          {{$customer->password}}
        </div>

        <div class="mb-3 mt-3">
          <label for="firstName" class="form-label">ชื่อ:</label>
          {{$customer->firstName}}
        </div>

        <div class="mb-3">
          <label for="lastName" class="form-label">นามสกุล:</label>
          {{$customer->lastName}}
        </div>

      </form>
    </div>  
@endsection