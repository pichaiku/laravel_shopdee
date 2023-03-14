@extends('layouts.admin')

@section('content')
@if(session()->get('success'))
  <script>    
    Swal.fire(
      'บันทึกข้อมูลเรียบร้อยแล้ว',
      '',
      'success'
    )
  </script>
@endif
      

  <div class="alert alert-secondary">
    <h2>ข้อมูลลูกค้า</h2>            
  </div>
  
  <!-- @if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}  
  </div><br />
  @endif -->
    
  <a href="{{ route('admin.customer.create') }}" class="btn btn-success mb-3">เพิ่มข้อมูล</a>

    <table id="table" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>ชื่อ</th>
        <th>นามสกุล</th>
        <th>อีเมล</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    
      @foreach($customers as $customer)
      <tr>
        <td>{{ $customer->firstName }}</td>
        <td>{{ $customer->lastName }}</td>
        <td>{{ $customer->email }}</td>
        <td><a href="{{ route('admin.customer.show',$customer->custID) }}" class="btn btn-info">แสดง</a></td>
        <td><a href="{{ route('admin.customer.edit',$customer->custID) }}" class="btn btn-warning">แก้ไข</a></td>
        <td>
          
          <form action="{{ route('admin.customer.destroy', $customer->custID)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit" onclick="return confirm('คุณต้องการลบข้อมูลรายการนี้ใช่หรือไม่')">ลบ</button>
          </form>
          
        </td>
      </tr>
      @endforeach
      
    </tbody>  
  </table>
@endsection

