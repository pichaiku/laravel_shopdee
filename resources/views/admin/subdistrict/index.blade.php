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
    <h2>ข้อมูลตำบล</h2>            
  </div>

    
  <a href="{{ route('admin.subdistrict.create') }}" id="btnCreate" class="btn btn-success mb-3">เพิ่มข้อมูล</a>

    <table id="table" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>รหัสตำบล</th>
        <th>ชื่อตำบล</th>
        <th>ชื่ออำเภอ</th>
        <th>ชื่อจังหวัด</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    
      @foreach($subdistricts as $subdistrict)
      <tr>        
        <td>{{ $subdistrict->subdistrictID }}</td>
        <td>{{ $subdistrict->subdistrictName }}</td>
        <td>{{ $subdistrict->districtName }}</td>
        <td>{{ $subdistrict->provinceName }}</td>
        <td><a href="{{ route('admin.subdistrict.show',$subdistrict->subdistrictID) }}" class="btn btn-info">แสดง</a></td>
        <td><a href="{{ route('admin.subdistrict.edit',$subdistrict->subdistrictID) }}" class="btn btn-warning">แก้ไข</a></td>
        <td>
          
          <form id="frmDelete{{$subdistrict->subdistrictID}}" action="{{ route('admin.subdistrict.destroy', $subdistrict->subdistrictID)}}" method="post">
            @csrf
            @method('DELETE')            
            <button id="btnDelete{{$subdistrict->subdistrictID}}" class="btn btn-danger" type="button" onclick="deleteCustomer('frmDelete{{$subdistrict->subdistrictID}}')">ลบ</button>
          </form>
          
        </td>
      </tr>
      @endforeach
      
    </tbody>  
  </table>
@endsection

