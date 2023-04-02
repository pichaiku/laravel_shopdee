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

@if(session()->get('delete'))
  <script>    
    Swal.fire(
      'คุณได้ทำการลบช้อมูลเรียบร้อยแล้ว',
      '',
      'success'
    )
  </script>
@endif

<script>
  function deleteCustomer(form){
    Swal.fire({
    title: 'คุณต้องการลบข้อมูลรายการนี้ใช่หรือไม่?',
    text: '',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',    
    confirmButtonText: 'ใช่',
    cancelButtonText: "ไม่ใช่"    
    }).then((result) => {
      if (result.isConfirmed) {    
        $("#"+form).submit();        
      }
    })    
  }
</script>


  <div class="alert alert-secondary">
    <h2>ข้อมูลลูกค้า</h2>            
  </div>
  
  <!-- @if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}  
  </div><br />
  @endif -->
    
  <a href="{{ route('admin.customer.create') }}" id="btnCreate" class="btn btn-success mb-3">เพิ่มข้อมูล</a>

    <table id="table" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>ชื่อผู้ใช้</th>
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
        <td>{{ $customer->username }}</td>
        <td>{{ $customer->firstName }}</td>
        <td>{{ $customer->lastName }}</td>
        <td>{{ $customer->email }}</td>
        <td><a href="{{ route('admin.customer.show',$customer->custID) }}" class="btn btn-info">แสดง</a></td>
        <td><a href="{{ route('admin.customer.edit',$customer->custID) }}" class="btn btn-warning">แก้ไข</a></td>
        <td>
          
          <form id="frmDelete{{$customer->custID}}" action="{{ route('admin.customer.destroy', $customer->custID)}}" method="post">
            @csrf
            @method('DELETE')            
            <button id="btnDelete{{$customer->custID}}" class="btn btn-danger" type="button" onclick="deleteCustomer('frmDelete{{$customer->custID}}')">ลบ</button>
          </form>
          
        </td>
      </tr>
      @endforeach
      
    </tbody>  
  </table>
@endsection

