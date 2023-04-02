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
  function deleteProduct(form){
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
    <h2>ข้อมูลสินค้า</h2>            
  </div>
  
  <!-- @if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}  
  </div><br />
  @endif -->
    
  <a href="{{ route('admin.product.create') }}" id="btnCreate" class="btn btn-success mb-3">เพิ่มข้อมูล</a>

    <table id="table" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>ชื่อสินค้า</th>
        <th>ราคา</th>
        <th>จำนวน</th>
        <th>ประเภทสินค้า</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    
      @foreach($products as $product)
      <tr>
        <td>{{ $product->productName }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->quantity }}</td>
        <td>{{ $product->typeName }}</td>
        <td><a href="{{ route('admin.product.show',$product->productID) }}" class="btn btn-info">แสดง</a></td>
        <td><a href="{{ route('admin.product.edit',$product->productID) }}" class="btn btn-warning">แก้ไข</a></td>
        <td>
          
          <form id="frmDelete{{$product->productID}}" action="{{ route('admin.product.destroy', $product->productID)}}" method="post">
            @csrf
            @method('DELETE')            
            <button id="btnDelete{{$product->productID}}" class="btn btn-danger" type="button" onclick="deleteProduct('frmDelete{{$product->productID}}')">ลบ</button>
          </form>
          
        </td>
      </tr>
      @endforeach
      
    </tbody>  
  </table>
@endsection

