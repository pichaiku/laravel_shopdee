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

    
  <a href="{{ route('admin.district.create') }}" id="btnCreate" class="btn btn-success mt-3 mb-3">เพิ่มข้อมูล</a>

    <table id="table" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>รหัสอำเภอ</th>
        <th>ชื่ออำเภอ</th>
        <th>ชื่อจังหวัด</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    
      @foreach($districts as $district)
      <tr>        
        <td>{{ $district->districtID }}</td>
        <td>{{ $district->districtName }}</td>
        <td>{{ $district->provinceName }}</td>
        <td style="width:20%;">
          
            <form id="frmDelete{{$district->districtID}}" action="{{ route('admin.district.destroy', $district->districtID)}}" method="post">
              @csrf
              @method('DELETE')    
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">                     
                <a href="{{ route('admin.district.show',$district->districtID) }}" class="btn btn-info">แสดง</a>
                <a href="{{ route('admin.district.edit',$district->districtID) }}" class="btn btn-warning">แก้ไข</a>
                <button id="btnDelete{{$district->districtID}}" class="btn btn-danger" type="button" onclick="deleteCustomer('frmDelete{{$district->districtID}}')">ลบ</button>
              </div>
            </form>
          
        </td>
      </tr>
      @endforeach
      
    </tbody>  
  </table>
@endsection

